<?php

namespace App\Http\Resources\Shop\Search;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'name' => $this->name,
            'img' => $this->photo,
            'price' => $this->price,
            'price_promotion' => $this->price_promotion,
            'slogan_text' => $this->slogan_text,
            'url' => $this->seo_url()
        ];
    }
}
