<?php

namespace App\Http\Requests\Shop\PageData;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use JetBrains\PhpStorm\ArrayShape;

class PageDataRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        if ($this->url === null) $this->merge(['url' => '']);
        if ($this->lang === null) $this->merge(['lang' => '']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */

    #[ArrayShape(['url' => "string", 'lang' => "string"])]
    public function rules(): array
    {
        return [
            'url' => 'string',
            'lang' => 'string'
        ];
    }
}
