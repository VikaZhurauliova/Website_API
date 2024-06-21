<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
{
    use ProductCreateUpdateRequestTrait;

    public function rules(): array
    {
        return array_merge($this->commonRules(), []);
    }
}
