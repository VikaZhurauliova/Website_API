<?php

namespace App\Http\Requests\Admin\Category;

use App\Http\Requests\Traits\SeoRequestTrait;

trait CategoryCreateUpdateRequestTrait
{
    use SeoRequestTrait;

    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->addSeoFields();
        foreach (
            [
                'parent_id',
                'is_video_review',
                'is_active_land_video_desktop',
                'is_active_land_video_mobile',
            ]
            as $prop) {
            if (empty($this->$prop)) {
                $this->merge([
                    $prop => null
                ]);
            }
        }
    }

    public function commonRules(): array
    {
        return array_merge($this->addSeoRules(), [
            'parent_id' => 'nullable|integer|exists:categories,id',
            'name' => 'required|string|max:255',
            'name_singular' => 'nullable|string|max:255',
            'description_short' => 'nullable|string',
            'description_full' => 'nullable|string',
            'description_app' => 'nullable|string',
            'is_video_review' => 'nullable|in:1',
            'name_video_review' => 'nullable|string|max:255',
        ]);
    }
}
