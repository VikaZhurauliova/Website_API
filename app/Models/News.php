<?php

namespace App\Models;

use App\Models\Traits\SeobleTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

// Новости
class News extends Model
{
    use SeobleTrait;
    protected $table = 'news';
    protected $guarded = false;
    protected $with = ['seo'];

    /**
     * Категории новости
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(
            CategoryForNews::class,
            'news_category',
            'news_id',
            'category_id'
        );
    }
}
