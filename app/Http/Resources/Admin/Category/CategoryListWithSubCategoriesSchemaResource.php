<?php

namespace App\Http\Resources\Admin\Category;

use App\Models\Domain;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryListWithSubCategoriesSchemaResource extends JsonResource
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

        return [
            'id' => $this->id,
            'url' => $this->seo_url($domain),
            'parent_id' => $this->parent_id,
            'name' => $this->name,
            'products_qnt' => $this->products->count(),
            'filters_qnt' => 5,
            'type' => $this->type ? $this->type->only(["id", 'name', 'description']) : null,
            'subcategories' => $this->subcategories->map(function($item) use ($domain) {
                return new self($item, $domain);
            }),
        ];
    }
}
