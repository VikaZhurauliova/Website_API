<?php

namespace App\Http\Requests\Shop\Order;

use App\Rules\MobilePhone;
use App\Services\AuthService;
use Illuminate\Foundation\Http\FormRequest;

class FastOrderRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'user_id' => auth()->user()?->id ?? null,
            'guest_id' => AuthService::getGuestToken() ?? null,
            'phone' => phoneToDBFormat($this->phone),
        ]);
    }

    public function rules(): array
    {
        return [
            'user_id' => 'nullable|required_without:guest_id|integer|exists:users,id',
            'guest_id' => 'nullable|required_without:user_id|string|starts_with:anon_',
            'name' => 'required|string',
            'phone' => ['required', 'numeric', new MobilePhone()],
            'type' => 'required|string|in:Заказать обратный звонок,Форма быстрого заказа',
            'domain' => 'required|string|exists:domains,domain',
            'url' => 'required|string',
            'product_id' => 'required_if:type,Форма быстрого заказа|integer|exists:products,id',
        ];
    }
}
