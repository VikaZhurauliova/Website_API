<?php

namespace App\Http\Resources\Shop\SearchTips;

use App\Models\Domain;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SearchTipsProductResource extends JsonResource
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
            'name' => isset($productRegion) ? $productRegion->name : $this->name,
            'img' => $this->photo,
            'price' => $this->price,
            'pricePromotion' => $this->price_promotion,
            'shortName' => isset($productRegion) ? $productRegion->short_name : $this->short_name,
            'url' => $this->seo_url($domain),
            'statusId' => $this->status_id
        ];
    }
}
