<?php

namespace App\Http\Requests\Shop;

use App\Http\Requests\Traits\DomainRequestTrait;
use App\Services\AuthService;
use Illuminate\Foundation\Http\FormRequest;

class FavouritesRequest extends FormRequest
{
    use DomainRequestTrait;

    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation(): void
    {
        $this->addDomainField();
        $this->merge([
            'user_id' => auth()->user()?->id ?? null,
            'guest_id' => AuthService::getGuestToken() ?? null
        ]);
    }


    public function rules(): array
    {
        return array_merge($this->addDomainRule(),
            [
                'user_id' => 'nullable|required_without:guest_id|integer|exists:users,id',
                'guest_id' => 'nullable|required_without:user_id|string|starts_with:anon_',
                'product_id' => 'required|integer|exists:products,id',
                'domain_id' => 'required|integer',
            ]);
    }

    public function messages(): array
    {
        return $this->addDomainMessages();
    }
}
