<?php

namespace App\Services\Shop\PageData;

use App\Models\Category;
use App\Models\Domain;
use App\Models\PageTemplate;

class CatalogBuilder extends EntityBuilder implements Builder
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
        PageDataService::addBreadcrumb($return, strip_tags($data?->seoble?->name));
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
        $categories = Category::where('parent_id', null)
            ->with('productsWithAllCatalogScopes')
            ->orderBy('sort')
            ->get()
            ->map(function (Category $category) use ($domain) {
                $products = $category->productsWithAllCatalogScopes;
                if ($products->count()) {
                    return [
                        'img' => $products->first()?->photo,
                        'name' => $category->name,
                        'url' => $category->seo_url($domain)
                    ];
                }
                return false;
            })
            ->reject(function ($value) {
                return $value === false;
            })->values();

        $return['data']['content'] = [
            'page' => [
                'id' => $data->seoble->id,
                'name' => $data->seoble->name,
            ],
            'categories' => $categories,
            'teaser' => $data->seoble->teaser,
        ];
    }

    public function setPageType(string $urn, mixed $data, array &$return): void
    {
        $return['data']['page_type'] = PageTemplate::find(2)->name;
    }

}
