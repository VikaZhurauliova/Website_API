<?php

namespace App\Http\Resources\Shop;

use App\Models\Domain;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShopProductsResource extends JsonResource
{
    public ?Domain $domain;

    public function __construct($resource, $domain = null)
    {
        parent::__construct($resource);
        $this->domain = $domain;
    }

    public function toArray(Request $request): array
    {
        $domain = $this->domain;
        $productRegion = $this->getProductRegionForDomain($domain);
        return [
            'id' => $this->id,
            'name' => $this->brand->name . ' ' . (isset($productRegion) ? $productRegion->model : $this->model),
            'price' => $this->price,
            'pricePromotion' => $this->price_promotion,
            'statusId' => $this->status_id,
            'storageStatus' => $this->storage_status,
            'url' => $this->seo_url($domain),
            'gallery' => $this->gallery,
            'shortName' => isset($productRegion) ? $productRegion->short_name :  $this->short_name,
        ];
    }
}
