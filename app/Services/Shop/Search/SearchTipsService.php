<?php

namespace App\Services\Shop\Search;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Collection;

// Данные для подсказок к поиску
class SearchTipsService extends BaseSearchService
{

    /**
     * Получение подсказок для выпадашки
     *
     * @param $searchTerm
     * @return mixed
     */
    public static function getFirstSearchTips($searchTerm): mixed
    {
        $searchTips = Product::where(function ($q) use ($searchTerm) {
            $searchTermTranslate = transliterate($searchTerm);
            $q->where('name', 'like', $searchTerm . '%')
                ->orWhere('name', 'like', $searchTermTranslate . '%');
        })
            ->visibleInCatalog()
            ->limit(10)
            ->pluck('name');

        return $searchTips->map(function ($name) {
            $words = explode(' ', $name);
            return $words[0];
        })->unique()->values();
    }


    /**
     * Список категорий для выпадашки
     * @param string $searchTerm
     * @return array
     */
    public static function getCategoriesForSearchTips(string $searchTerm): array
    {
        return self::searchCategories($searchTerm)->take(3)
            ->map(function (Category $category) {
                return [
                    'id' => $category->id,
                    'name' => $category->name,
                    'parent_name' => $category->parent_name,
                    'img' => $category->img,
                    'min_price' => $category->min_price,
                    'url' => $category->seo_url()
                ];
            })
            ->values()
            ->toArray();
    }

    /**
     * Получение новых товаров
     * @return Collection
     */
    public static function getNewProducts(): Collection
    {
        return Product::with('gallery')
            ->visibleInCatalog()
            ->where('badge_new', 1)
            ->limit(20)
            ->get();
    }

}
