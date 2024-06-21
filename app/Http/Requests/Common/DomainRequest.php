<?php

namespace App\Http\Requests\Common;

use App\Http\Requests\Traits\DomainRequestTrait;
use App\Models\Domain;
use App\Services\AuthService;
use Illuminate\Foundation\Http\FormRequest;
use function Symfony\Component\Translation\t;

class DomainRequest extends FormRequest
{
    use DomainRequestTrait;

    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation(): void
    {
        $this->addDomainField();
    }

    public function rules(): array
    {
        return $this->addDomainRule();
    }

    public function messages(): array
    {
        return $this->addDomainMessages();
    }
}
