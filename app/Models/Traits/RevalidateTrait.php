<?php

namespace App\Models\Traits;

use App\Services\UrlService;

trait RevalidateTrait
{
    /**
     * Пути для ревалидации: где используется объект
     * @return string[]
     */
    public function getRevalidatePathAttribute(): array
    {
        return UrlService::getRevalidatePaths($this->seo);
    }

}
