<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class BannerResource extends JsonResource
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
            'html' => $this->html,
            'delay' => $this->delay,
            'dateStart' => $this->date_start,
            'dateEnd' => $this->date_end,
            'status' => (int)$this->status,
            'isActive' => (int)$this->is_active,
            'imagePreview' => $this->image_preview ? Storage::url($this->image_preview) : null,
        ];
    }
}
