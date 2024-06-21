<?php

namespace App\Http\Resources\Admin\Category;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $products = $this->products()->with('params.filters', 'params.param')->get();

        $params = $products->flatMap(function ($product) {
            return $product->params;
        })->sortBy('param.name')->groupBy('param.name');

        $filters = $params->map(function ($paramGroup, $paramName) {
            return [
                'name' => $paramName,
                'filters' => $paramGroup->flatMap(function ($param) {
                    return $param->filters->map(function ($filter) {
                        return $filter->name;
                    });
                })->unique()->values()->all()
            ];
        })->values();

        return array_merge(parent::toArray($request), [
            'seo_url' => $this->seo?->url,
            'seo_title' => $this->seo?->title,
            'seo_keywords' => $this->seo?->keywords,
            'seo_description' => $this->seo?->description,
            'filters' => ['params' => $filters]
        ]);
    }
}
