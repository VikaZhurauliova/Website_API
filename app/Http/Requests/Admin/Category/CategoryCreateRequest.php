<?php

namespace App\Http\Requests\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;

class CategoryCreateRequest extends FormRequest
{
    use CategoryCreateUpdateRequestTrait;

    public function rules(): array
    {
        return array_merge($this->commonRules(), []);
    }
}
