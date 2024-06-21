<?php

namespace App\Http\Requests\AdminRegion\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductRegionUpdateOrCreateRequest extends FormRequest
{
    use ProductRegionCreateUpdateRequestTrait;

    public function rules(): array
    {
        return array_merge($this->commonRules(), [
            'region_name' => 'nullable|string|max:255',
            'region_short_name' => 'nullable|string|max:255',
            'region_model' => 'nullable|string|max:255',
            'region_isWithLanding' => 'nullable|in:1',
            'region_landingUrl' => 'nullable|string|max:255',
            'region_text_full' => 'nullable|string',
            'region_text_short' => 'nullable|string|max:255',
        ]);
    }
}
