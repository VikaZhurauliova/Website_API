<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    use ProductCreateUpdateRequestTrait;

    public function rules(): array
    {
        return array_merge($this->commonRules(), [
            'id' => 'required|integer|exists:products,id',
        ]);
    }
}
