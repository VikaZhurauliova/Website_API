<?php

namespace App\Http\Requests\Admin\Color;

use App\Rules\Base64Image;
use Illuminate\Foundation\Http\FormRequest;

class ColorUpdateRequest extends FormRequest
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
        $this->merge([
            'is_code' => $this->isCode,

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
            'name' => 'nullable',
            'code' => 'nullable|unique:colors',
            'image' => 'nullable|string',
            'is_code' => 'nullable|boolean',
        ];
    }
}
