<?php

namespace App\Models;

use App\Models\Traits\RevalidateTrait;
use App\Models\Traits\SeobleTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use OwenIt\Auditing\Contracts\Auditable;

// Товары
class Product extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes, SeobleTrait;
    use RevalidateTrait {
        getRevalidatePathAttribute as initialGetRevalidatePathAttribute;
    }

    protected $table = 'products';
    protected $guarded = false;
    protected $with = ['seo'];
    protected $appends = [
        'photo'
    ];
    protected array $storage_status = ['code' => 'not-avail', 'text' => 'Нет в наличии'];

    /**
     * Товары, видимые в каталоге по их статусу
     * @param Builder $query
     * @return void
     */
    public function scopeVisibleInCatalog(Builder $query): void
    {
        $user = auth()->user();
        if ($user === null || $user->cannot('use_admin_panel')) {
            $query->whereNotIn('status_id', [2, 3, 4]);
        }
    }

    /**
     * Связи товаров в каталоге
     * @param Builder $query
     * @return void
     */
    public function scopeCatalogRelations(Builder $query): void
    {
        $query->with(['gallery', 'brand', 'status', 'regions']);
    }

    public function scopeAllCatalogScopes(Builder $query): void
    {
        $query->visibleInCatalog()->catalogRelations();
    }

    /**
     * Бренд
     * @return BelongsTo
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    /**
     * История изменений
     * @return MorphMany
     */
    public function audits(): MorphMany
    {
        return $this->morphMany(Audit::class, 'auditable');
    }

    /**
     * Видео десктоп в лендинге
     * @return BelongsTo
     */
    public function landVideoDesktop(): BelongsTo
    {
        return $this->belongsTo(File::class, 'land_video_file_id_desktop');
    }

    /**
     * Видео мобайл в лендинге
     * @return BelongsTo
     */
    public function landVideoMobile(): BelongsTo
    {
        return $this->belongsTo(File::class, 'land_video_file_id_mobile');
    }

    /**
     * Статус товара
     * @return BelongsTo
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(ProductStatus::class, 'status_id');
    }

    /**
     * Категория для сравнения
     * @return BelongsTo
     */
    public function categoryCompare(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_compare_id');
    }

    /**
     * Категория для хлебных крошек
     * @return BelongsTo
     */
    public function categoryBreadcrumbs(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_breadcrumbs_id');
    }

    /**
     * Категории товара
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(
            Category::class,
            'product_category',
            'product_id',
            'category_id'
        )->orderBy('sort');
    }

    /**
     * Технические характеристики
     * @return HasMany
     */
    public function params(): HasMany
    {
        return $this->hasMany(ProductParam::class, 'product_id')->orderBy('sort');
    }

    /**
     * Аренда
     * @return HasMany
     */
    public function rent(): HasMany
    {
        return $this->hasMany(ProductRent::class, 'product_id')
            ->with('rentType');
    }

    /**
     * Аренда товара, отсортированная по сортировке типов аренды
     */
    public function getRentSortedAttribute(): Collection
    {
        return $this->rent->sortBy('rentType.sort');
    }

    /**
     * Аренда товара сразу с сортировкой по типу аренды
     * @return BelongsToMany
     */
    public function rent_test(): BelongsToMany
    {
        return $this
            ->belongsToMany(RentType::class, 'product_rent', 'product_id', 'rent_id')
            ->withPivot('borboza_id', 'price', 'price_promotion', 'price_preorder')
            ->orderBy('sort', 'ASC')
            ->as('product_rent');
    }

    /**
     * Размер
     * @return HasMany
     */
    public function size(): HasMany
    {
        return $this->hasMany(ProductSize::class, 'product_id')
            ->with('size');
    }

    /**
     * С этим товаром покупают
     * @return BelongsToMany
     */
    public function additional_products(): BelongsToMany
    {
        return $this->belongsToMany(
            Product::class,
            'product_additional',
            'product_id',
            'relation_id'
        )
            ->orderByPivot('sort');
    }

    /**
     * Галерея фото и видео товаров
     * @return HasMany
     */
    public function gallery(): hasMany
    {
        return $this->hasMany(ProductGallery::class, 'product_id')->orderBy('sort');
    }

    /**
     * Первое фото в галерее в самом маленьком размере
     * @return null|string|array Url первого фото в самом маленьком размере
     */
    public function getPhotoAttribute(): null|string|array
    {
        $firstPhotoInGalleryFiles = $this->gallery?->where('type', 'photo')?->first()?->photos;
        if ($firstPhotoInGalleryFiles === null) return null;
        return $firstPhotoInGalleryFiles[config('files.productPhotoSizes')[0]] ?? reset($firstPhotoInGalleryFiles);
    }

    public function colors(): BelongsToMany
    {
        return $this->belongsToMany(
            Color::class,
            'product_colors',
            'product_id',
            'color_id'
        );
    }

    /**
     * Пути для ревалидации: где используется объект
     * @return string[]
     */
    public function getRevalidatePathAttribute(): array
    {
        $paths = $this->initialGetRevalidatePathAttribute();
        $this->categories->each(function ($category) use (&$paths) {
            foreach ($category->revalidate_path as $url) {
                $paths[] = $url;
            }
        });
        return $paths;
    }

    /**
     * @return HasMany
     */
    public function ordeΩrs(): HasMany
    {
        return $this->hasMany(Order::class);
    }

}
