<?php

namespace App\Http\Resources\Admin\Page;

use App\Models\Page;
use App\Models\PageTemplate;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PageResource extends JsonResource
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
            'name' => $this->name,
            'isPublished' => boolval($this->seo?->status),
            'seo_url' => $this->seo?->url,
            'seo_title' => $this->seo?->title,
            'seo_keywords' => $this->seo?->keywords,
            'seo_description' => $this->seo?->description,
            'body' => $this->body,
            'teaser' => $this->teaser,
            'template_id' => $this->template_id,
            'template_types' => PageTemplate::orderBy('name')->get()->toArray(),
            'landing_url' => $this->landing_url,
            'seo' => $this->seo
        ];

    }
}
