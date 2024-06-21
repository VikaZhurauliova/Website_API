<?php

namespace App\Services\Shop\Search;

use App\Models\Category;
use App\Models\Domain;
use App\Models\Product;
use Illuminate\Support\Collection;

class BaseSearchService
{
    /**
     * Получение товаров
     *
     * @param Domain $domain
     * @param ?string $searchTerm поисковый запрос
     * @param int|null $page номер страницы при пагинации
     * @return Collection
     */
    public static function searchProducts(Domain $domain, ?string $searchTerm = null, ?int $page = null): Collection
    {
        return Product::allCatalogScopes()
            ->when(!empty($searchTerm), function ($q) use ($domain, $page, $searchTerm) {
                $searchTermTranslate = transliterate($searchTerm);
                return $q->where('name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('short_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('text_short', 'like', '%' . $searchTerm . '%')
                    ->orWhere('search_keywords', 'like', '%' . $searchTerm . '%')
                    ->orWhere('name', 'like', '%' . $searchTermTranslate . '%')
                    ->orWhere('short_name', 'like', '%' . $searchTermTranslate . '%')
                    ->orWhere('text_short', 'like', '%' . $searchTermTranslate . '%')
                    ->orWhere('search_keywords', 'like', '%' . $searchTermTranslate . '%')
                    ->orWhereHas('regions', function ($q) use ($domain, $searchTerm, $searchTermTranslate) {
                        return $q->where('domain_id', $domain->id)
                            ->where(function ($q) use ($searchTerm, $searchTermTranslate) {
                                $q->where('name', 'like', '%' . $searchTerm . '%')
                                    ->orWhere('short_name', 'like', '%' . $searchTerm . '%')
                                    ->orWhere('text_short', 'like', '%' . $searchTerm . '%')
                                    ->orWhere('name', 'like', '%' . $searchTermTranslate . '%')
                                    ->orWhere('short_name', 'like', '%' . $searchTermTranslate . '%')
                                    ->orWhere('text_short', 'like', '%' . $searchTermTranslate . '%')
                                ;
                            });
                    });
            })
            ->when($page !== null, function ($q) use ($page) {
                $page = max(0, (int)($page - 1));
                return $q->offset($page * 8)->limit(8);
            })
            ->get()
            ->catalogSort();
    }

    /**
     * Ищет категории по запросу $searchTerm для выпадашки и результатов поиска
     * @param string $searchTerm
     * @return Collection
     */
    public static function searchCategories(string $searchTerm): Collection
    {
        return Category::where(function ($q) use ($searchTerm) {
            $searchTermTranslate = transliterate($searchTerm);
            $q->where('name', 'like', '%' . $searchTerm . '%')
                ->orWhere('name', 'like', '%' . $searchTermTranslate . '%');
        })
            ->with(['parent', 'productsWithAllCatalogScopes'])
            ->get()
            ->map(function (Category $category) {
                $products = $category->productsWithAllCatalogScopes->filter(function ($product) {
                    return $product->sort_price > 0;
                });
                $category->parent_name = $category->parent?->name ?? null;
                $category->img = $products->first()?->photo;
                $category->max_price = $products->first()?->sort_price;
                $category->min_price = $products->min('sort_price');
                $category->url = $category->seo_url();
                return $category;
            })->sortByDesc(function (Category $category) {
                return $category->max_price;
            });
    }

}
