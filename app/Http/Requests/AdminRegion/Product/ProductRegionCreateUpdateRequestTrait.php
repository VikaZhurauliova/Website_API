<?php

namespace App\Http\Requests\AdminRegion\Product;

use App\Http\Requests\Traits\SeoRegionRequestTrait;

trait ProductRegionCreateUpdateRequestTrait
{
    use SeoRegionRequestTrait;

    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->addSeoRegionFields();
    }

    protected function commonRules(): array
    {
        return array_merge($this->addSeoRegionRules(), []);
    }
}
