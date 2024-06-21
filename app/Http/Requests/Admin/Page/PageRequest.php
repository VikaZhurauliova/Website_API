<?php

namespace App\Http\Requests\Admin\Page;

use App\Http\Requests\Traits\SeoRequestTrait;
use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
{
    use SeoRequestTrait;

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
        $this->addSeoFields();
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return array_merge($this->addSeoRules(), [
            'name' => 'nullable|string|max:255',
            'template_id' => 'nullable|integer',
            'teaser' => 'nullable|string|max:255',
            'body' => 'nullable|string',
            'isWithForm' => 'required|bool',
            'isWithLanding' => 'required|bool',
            'landing_url' => 'nullable|string|max:255',
        ]);
    }
}
