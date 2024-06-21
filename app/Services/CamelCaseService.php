<?php

namespace App\Services;

class CamelCaseService
{
    public function convertKeysToCamelCase($data): array
    {
        $camelCaseData = [];

        foreach ($data as $key => $value) {
            $camelCaseKey = lcfirst(str_replace(' ', '', ucwords(str_replace(['_', '-'], ' ', $key))));
            $camelCaseData[$camelCaseKey] = is_array($value) ? $this->convertKeysToCamelCase($value) : $value;
        }

        return $camelCaseData;
    }
}
