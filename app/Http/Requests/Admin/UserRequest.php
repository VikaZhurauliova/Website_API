<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'nullable|email|string',
            'first_name' => 'nullable|string',
            'middle_name' => 'nullable|string',
            'last_name' => 'nullable|string',
            'role' => 'nullable|string',
            'phone' => 'nullable|string',
            'customer_id' => 'nullable',
            'per_page' => [
                'nullable',
                'integer',
                Rule::in((range(1,200))),
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'per_page.in' => 'Максимальное значение для поля per_page - 200',
        ];
    }
}
