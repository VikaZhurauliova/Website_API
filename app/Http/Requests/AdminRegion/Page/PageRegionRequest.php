<?php

namespace App\Http\Requests\AdminRegion\Page;

use App\Http\Requests\Traits\SeoRegionRequestTrait;
use Illuminate\Foundation\Http\FormRequest;

class PageRegionRequest extends FormRequest
{
    use SeoRegionRequestTrait;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $this->addSeoRegionFields();
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return array_merge($this->addSeoRegionRules(), [
            'region_name' => 'required|string|max:255',
            'region_template_id' => 'required|integer|exists:page_templates,id',
            'region_teaser' => 'nullable|string|max:255',
            'region_body' => 'nullable|string',
            'region_isWithForm' => 'required|bool',
            'region_isWithLanding' => 'required|bool',
            'region_landing_url' => 'nullable|string|max:255',
        ]);
    }
}
