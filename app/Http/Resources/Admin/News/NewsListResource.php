<?php

namespace App\Http\Resources\Admin\News;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class NewsListResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $url = $this->seo ? $this->seo->url : null;

        return [
            'id' => $this->id,
            'type' => $this->type,
            'title' => $this->title,
            'created_at' => $this->created_at,
            'characters' => strlen($this->body),
            'url' => $url,
        ];
    }
}
