<?php

namespace App\Http\Resources\Shop;

use App\Models\Domain;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompareResource extends JsonResource
{
    public ?Domain $domain;

    public function __construct($resource, $domain = null)
    {
        parent::__construct($resource);
        $this->domain = $domain;
    }
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'product' => new ShopProductsResource($this->product, $this->domain),
        ];
    }
}
