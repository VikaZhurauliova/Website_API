<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\SearchRequest;
use App\Http\Resources\Shop\SearchTips\SearchTipsProductResource;
use App\Http\Resources\Shop\ShopProductsResource;
use App\Models\Domain;
use App\Services\Shop\Search\SearchResultsService;
use App\Services\Shop\Search\SearchTipsService;
use App\Services\Shop\Search\UserSearchHistoryService;

class SearchController extends Controller
{
    /**
     * Поиск товаров с пагинацией для страницы результатов поиска
     * @param SearchRequest $request
     * @return array
     */
    public function searchProducts(SearchRequest $request): array
    {
        $data = $request->validated();
        $domain = Domain::find($data['domain_id']);
        if ($domain === null) return ['data' => []];

        // Получение товаров
        $products = SearchResultsService::searchProducts($domain, $data['search'], $data['page']);

        return [
            'data' => $products->map(function ($product) use ($domain) {
                return new ShopProductsResource($product, $domain);
            })->values()
        ];
    }

    /**
     * Поиск категорий для страницы результатов поиска
     * @param SearchRequest $request
     * @return array
     */
    public function searchCategories(SearchRequest $request): array
    {
        $data = $request->validated();
        if (!empty($data['search'])) UserSearchHistoryService::store($data);

        return [
            'data' => SearchResultsService::getCategoriesForSearchResults($data['search']),
        ];
    }

    /**
     * Получение подсказок данных из поисковой строки.
     * @param SearchRequest $request
     * @return array
     */
    public function searchTips(SearchRequest $request): array
    {
        $data = $request->validated();
        $searchTerm = $data['search'] ?? null;
        $domain = Domain::find($data['domain_id']);
        if ($domain === null) return ['data' => []];

        if (empty($searchTerm)) {
            // Если запрос приходит пустой
            // Новинки
            $newProducts = SearchTipsService::getNewProducts()->map(function ($product) use ($domain) {
                return new SearchTipsProductResource($product, $domain);
            })->values();
            // История поиска
            $userSearchHistory = UserSearchHistoryService::getUserSearchHistory($data['domain_id']);
        } else {
            // Товары
            $products = SearchTipsService::searchProducts($domain, $searchTerm)->take(30)
                ->map(function ($product) use ($domain) {
                    return new SearchTipsProductResource($product, $domain);
                })->values();
            // Подсказки
            $firstSearchTips = SearchTipsService::getFirstSearchTips($searchTerm);
            // Категории
            $categories = SearchTipsService::getCategoriesForSearchTips($searchTerm);
        }

        return [
            'data' => [
                'searchTips' => $firstSearchTips ?? [],
                'history' => $userSearchHistory ?? [],
                'categories' => $categories ?? [],
                'products' => $products ?? [],
                'newProducts' => $newProducts ?? [],
            ],
        ];
    }

}
