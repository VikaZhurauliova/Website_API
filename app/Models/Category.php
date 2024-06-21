<?php

namespace App\Models;

use App\Models\Traits\RevalidateTrait;
use App\Models\Traits\SeobleTrait;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

// Категории товаров
class Category extends Model implements Auditable
{
    use SeobleTrait, RevalidateTrait;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'categories';
    protected $guarded = false;
    protected $with = ['seo'];

    protected $appends = [];

    /**
     * Подкатегории
     * @return HasMany
     */
    public function subcategories(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id')
            ->with('subcategories')
            ->orderBy('sort');
    }

    /**
     * Родительская категория
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    /**
     * Товары в категории
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(
            Product::class,
            'product_category',
            'category_id',
            'product_id'
        );
    }

    /**
     * Фильтры в категории
     *
     * @return HasManyThrough
     */
    public function filters(): HasManyThrough
    {
        return $this->hasManyThrough(Filter::class, ProductParam::class, 'param_id', 'id');
    }


    /**
     * @return BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(CategoryType::class, 'category_type_id');
    }

    /**
     * @return HasMany
     */
    public function category_regions(): HasMany
    {
        return $this->hasMany(CategoryRegion::class);
    }

    /**
     * @param $domain
     * @return CategoryRegion|null
     */
    public function categoryRegion($domain): ?CategoryRegion
    {
        return CategoryRegion::where('domain_id', $domain->id)->where('category_id', $this->id)->first();
    }

    /**
     * @param $domain
     * @return string
     */
    public function getCategoryName($domain): string
    {
        return strip_tags($this->categoryRegion($domain)?->name ?? $this->name);
    }
}
