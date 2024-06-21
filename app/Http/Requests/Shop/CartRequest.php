<?php

namespace App\Http\Requests\Shop;

use App\Http\Requests\Traits\DomainRequestTrait;
use App\Models\Domain;
use App\Services\AuthService;
use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
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
            'guest_id' => AuthService::getGuestToken() ?? null,
            'domain_id' => Domain::where('domain', $this->domain)->first()?->id
        ]);
    }

    public function rules(): array
    {
        return array_merge($this->addDomainRule(),
            [
                'quantity' => 'integer',
                'domain_id' => 'required|integer',
                'product_id' => 'required|integer|exists:products,id',
                'user_id' => 'nullable|required_without:guest_id|integer|exists:users,id',
                'guest_id' => 'nullable|required_without:user_id|string|starts_with:anon_'
            ]);
    }

    public function messages(): array
    {
        return $this->addDomainMessages();
    }
}
