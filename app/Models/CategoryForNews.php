<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

// Категории новостей
class CategoryForNews extends Model
{
    protected $table = 'category_for_news';
    protected $guarded = false;
    public $timestamps = false;

    /**
     * Новости в категории
     * @return BelongsToMany
     */
    public function news(): BelongsToMany
    {
        return $this->belongsToMany(
            News::class,
            'news_category',
            'category_id',
            'news_id'
        );
    }
}
