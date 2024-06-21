<?php

namespace App\Services\Shop\PageData;

use App\Http\Resources\Shop\ShopProductsResource;
use App\Models\Banner;
use App\Models\Domain;
use App\Models\Page;
use App\Models\PageTemplate;
use App\Models\Product;

class MainPageBuilder extends EntityBuilder implements Builder
{
    /**
     * Данные главной страницы
     * @param string $urn
     * @param mixed $data
     * @param array $return
     * @param Domain $domain
     * @return void
     */
    public function addPageData(string $urn, mixed $data, array &$return, Domain $domain): void
    {
        $return['data']['content']['page'] = [

            'id' => $data->seoble->id,

            'hitProducts' => Product::where('badge_bestseller', 1)
                ->allCatalogScopes()
                ->get()
                ->catalogSort()
                ->map(function($product) use ($domain) {
                    return new ShopProductsResource($product, $domain);
                })->values(),

            'banners' => Banner::where('is_active',1)
                ->where('status', 1)
                ->orderBy('position')
                ->get(),
        ];
    }

    public function setPageType(string $urn, mixed $data, array &$return): void
    {
        $return['data']['page_type'] = PageTemplate::find(5)->name;
    }

    public function addAdminLink(mixed $data, array &$return, Domain $domain): void
    {
        $return['data']['adminLink'] = getAdminUrl('pages/' . $data->seoble_id, $domain);
    }

}
