<?php

namespace App\Http\Requests\AdminRegion\Sites;

use Illuminate\Foundation\Http\FormRequest;

class SiteUpdateOrCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'domain' => 'required|string',
            'phone' => 'nullable|string',
            'group_code' => 'required|string',
            'main' => 'nullable|boolean',
            'company' => 'nullable|string',
            'address' => 'nullable|string',
            'schedule' => 'nullable|string',
            'meta' => 'nullable|string',
            'gtm' => 'nullable|string',
            'yandex_verification' => 'nullable|string',
            'ymId' => 'nullable|integer',
            'ym_webvisor' => 'nullable|boolean',
            'scripts' => 'nullable|string',
            'robots' => 'nullable|string',
            'delivery_text' => 'nullable|string',
            'delivery_cost' => 'nullable|integer',
            'delivery_free_from' => 'nullable|integer',
        ];
    }
}
