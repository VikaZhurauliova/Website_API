<?php

namespace App\Http\Resources\Shop;

use App\Models\Domain;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CatalogResource extends JsonResource
{
    public Domain $domain;

    public function __construct($resource, $domain)
    {
        parent::__construct($resource);
        $this->domain = $domain;
    }

    public function toArray(Request $request): array
    {
        $domain = $this->domain;
        return [
            'href' => $this->seo_url($domain),
            'id' => $this->id,
            'name' => $this->category_regions?->first()?->name ?? $this->name,
            'subcategories' => $this->subcategories->map(function($item) use ($domain) {
                return new self($item, $domain);
            }),
        ];
    }
}
