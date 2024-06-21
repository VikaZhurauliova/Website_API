<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SeoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'url' => $this->url,
            'title' => $this->title,
            'keywords' => $this->keywords,
            'description' => $this->description,
            'status' => $this->status,
            'canonical' => $this->canonical,
            'meta' => $this->whenLoaded('seoMeta'),
        ];
    }
}
