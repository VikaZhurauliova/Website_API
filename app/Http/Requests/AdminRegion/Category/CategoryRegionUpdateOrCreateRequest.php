<?php

namespace App\Http\Requests\AdminRegion\Category;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRegionUpdateOrCreateRequest extends FormRequest
{
    use CategoryRegionCreateUpdateRequestTrait;

    public function rules(): array
    {
        return array_merge($this->commonRules(), [
            'region_name' => 'nullable|string|max:255',
            'region_description_full' => 'nullable|string',
            'region_description_short' => 'nullable|string|max:255',
        ]);
    }
}
