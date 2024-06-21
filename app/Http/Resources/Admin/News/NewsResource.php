<?php

namespace App\Http\Resources\Admin\News;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class NewsResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return array_merge(parent::toArray($request), [
            'categories' => $this->categories,
            'image_src' => $this->image_src ? Storage::url($this->image_src) : null,
            'seo_url' => $this->seo?->url,
            'seo_title' => $this->seo?->title,
            'seo_keywords' => $this->seo?->keywords,
            'seo_description' => $this->seo?->description,
        ]);
    }
}
