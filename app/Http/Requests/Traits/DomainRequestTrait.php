<?php

namespace App\Http\Requests\Traits;

use App\Models\Domain;

trait DomainRequestTrait
{
    protected function addDomainField(): void
    {
        $this->merge([
            'domain_id' => Domain::where('domain', $this->domain)->first()?->id
        ]);
    }

    protected function addDomainRule(): array
    {
        return [
            'domain_id' => 'required|integer',
        ];
    }

    public function addDomainMessages(): array
    {
        return [
            'domain_id.required' => 'Домен не передан или не обслуживается этим API'
        ];
    }
}
