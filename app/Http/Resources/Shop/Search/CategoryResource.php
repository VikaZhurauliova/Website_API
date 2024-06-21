<?php

namespace App\Http\Resources\Shop\Search;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Получение данных для Товара
     *
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'parent_name' => $this->parent?->name ?? null,
            'img' => $this->products->sortByDesc('price')->first()->photo,
            'min_price' => $this->products->min('price'),
            'url' => $this->seo_url()
        ];
    }
}
