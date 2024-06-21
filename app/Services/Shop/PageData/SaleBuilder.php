<?php

namespace App\Services\Shop\PageData;

use App\Http\Resources\Shop\ShopProductsResource;
use App\Models\Domain;
use App\Models\PageTemplate;
use App\Models\Product;
use Illuminate\Support\Str;

class SaleBuilder extends EntityBuilder implements Builder
{

    /**
     * @param string $urn
     * @param mixed $data
     * @param array $return
     * @param Domain $domain
     * @return void
     */
    public function addPageData(string $urn, mixed $data, array &$return, Domain $domain): void
    {
        $return['data']['content'] = [
            'page' => [
                'id' => $data->seoble->id,
                'name' => $data->seoble->name,
                'body' => $data->seoble->body
            ],
            'products' => Product::where('badge_promo', 1)
                ->allCatalogScopes()
                ->get()
                ->catalogSort()
                ->map(function($product) use ($domain) {
                    return new ShopProductsResource($product, $domain);
                })->values(),
        ];
    }

    public function setPageType(string $urn, mixed $data, array &$return): void
    {
        $return['data']['page_type'] = PageTemplate::find(3)->name;
    }

    public function addAdminLink(mixed $data, array &$return, Domain $domain): void
    {
        $return['data']['adminLink'] = getAdminUrl('pages/' . $data->seoble_id, $domain);
    }

}
