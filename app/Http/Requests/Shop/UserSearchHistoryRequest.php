<?php

namespace App\Http\Requests\Shop;

use App\Models\Domain;
use Illuminate\Foundation\Http\FormRequest;

class UserSearchHistoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'domain_id' => Domain::where('domain', $this->domain)->first()?->id
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'search' => 'nullable| string',
            'domain_id' => 'required|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'domain_id.required' => 'Данный домен не поддерживается API.'
        ];
    }
}
