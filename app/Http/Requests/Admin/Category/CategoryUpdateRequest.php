<?php

namespace App\Http\Requests\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
{
    use CategoryCreateUpdateRequestTrait;

    public function rules(): array
    {
        return array_merge($this->commonRules(), [
            'id' => 'required|integer|exists:categories,id',
        ]);
    }
}
