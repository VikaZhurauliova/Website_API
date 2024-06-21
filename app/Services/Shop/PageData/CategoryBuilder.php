<?php

namespace App\Services\Shop\PageData;

use App\Http\Resources\Shop\ShopProductsResource;
use App\Models\Category;
use App\Models\Domain;

class CategoryBuilder extends EntityBuilder implements Builder
{
    /**
     * @param string $urn
     * @param mixed $data
     * @param array $return
     * @param string $lang
     * @param Domain $domain
     * @return void
     */
    public function addBreadCrumbs(string $urn, mixed $data, array &$return, string $lang, Domain $domain): void
    {
        PageDataService::setMainPageBreadcrumb($return, $domain);
        $this->addCatalogBreadCrumb($return, $lang, $domain);
        $category = $data?->seoble;
        if ($category instanceof (Category::class)) {
            if ($category->parent !== null) {
                PageDataService::addBreadcrumb($return, $category->parent->getCategoryName($domain), $category->parent->seo_url($domain));
            }
            PageDataService::addBreadcrumb($return, $category->getCategoryName($domain));
        }
    }

    /**
     * @param string $urn
     * @param mixed $data
     * @param array $return
     * @param Domain $domain
     * @return void
     */
    public function addPageData(string $urn, mixed $data, array &$return, Domain $domain): void
    {
        $category = $data->seoble;
        $categoryRegion = $category->categoryRegion($domain);

        if ($category instanceof Category) {
            $categoryData = [
                'id' => $category->id,
                'name' => $categoryRegion?->name ?? $category->name,
                'descriptionShort' => $category->description_short,
                'descriptionFull' => $category->description_full
            ];

            if (isset($categoryRegion?->description_short)) $categoryData['descriptionShort'] = $categoryRegion?->description_short;
            if (isset($categoryRegion?->description_full)) $categoryData['descriptionFull'] = $categoryRegion?->description_full;

            $productsData = $category->productsWithAllCatalogScopes->catalogSort()->map(function($product) use ($domain) {
                return new ShopProductsResource($product, $domain);
            })->values();

            $return['data']['content'] = [
                'category' => $categoryData,
                'products' => $productsData,
            ];
        }
    }

    public function addAdminLink(mixed $data, array &$return, Domain $domain): void
    {
        $return['data']['adminLink'] = getAdminUrl('categories/' . $data->seoble_id, $domain);
    }

}
