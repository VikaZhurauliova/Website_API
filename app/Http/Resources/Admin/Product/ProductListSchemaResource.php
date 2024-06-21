<?php

namespace App\Http\Resources\Admin\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductListSchemaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $mainCategory = $this->categoryBreadcrumbs?->parent ?? $this->categoryBreadcrumbs;
        $subcategories = $mainCategory ? $mainCategory->subcategories->pluck('name')->toArray() : [];

        return [
            'id' => $this->id,
            'name' => $this->name,
            'site_url' => $this->seo_url(),
            'search_keywords' => $this->search_keywords,
            'model' => $this->model,
            'brand' => $this->brand?->name,
            'price' => $this->price,
            'popularity' => $this->popularity,
            'category' => [
                'id' => $mainCategory ? $mainCategory->id : null,
                'subcategories' => $subcategories,
                'title' => $mainCategory ? $mainCategory->name : null,
            ],
            'status' => $this->status?->name,
        ];
    }
}
