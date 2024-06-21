<?php

namespace App\Http\Requests\Shop;

use App\Http\Requests\Traits\DomainRequestTrait;
use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
{
    use DomainRequestTrait;

    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation(): void
    {
        $this->addDomainField();
        if (!isset($this->search)) $this->merge([
            'search' => null
        ]);
        if (!isset($this->page)) $this->merge([
            'page' => null
        ]);
    }

    public function rules(): array
    {
        return array_merge($this->addDomainRule(),
            [
                'search' => 'nullable|string',
                'page' => 'nullable|integer',
            ]
        );
    }

    public function messages(): array
    {
        return $this->addDomainMessages();
    }

}
