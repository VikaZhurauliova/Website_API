<?php

namespace App\Http\Requests\Shop\Order;

use App\Http\Requests\Traits\DomainRequestTrait;
use App\Rules\MobilePhone;
use App\Services\AuthService;
use Illuminate\Foundation\Http\FormRequest;

class CartOrderRequest extends FormRequest
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
            'phone' => phoneToDBFormat($this->phone),
        ]);
    }

    public function rules(): array
    {
        return array_merge($this->addDomainRule(),
            [
                'user_id' => 'nullable|required_without:guest_id|integer|exists:users,id',
                'guest_id' => 'nullable|required_without:user_id|string|starts_with:anon_',
                'name' => 'required|string',
                'email' => 'nullable|string|email',
                'phone' => ['required', 'numeric', new MobilePhone()],
                'address' => 'nullable|string',
                'comment' => 'nullable|string',
                'domain' => 'required|string|exists:domains,domain',
            ]);
    }

    public function messages(): array
    {
        return $this->addDomainMessages();
    }

}
