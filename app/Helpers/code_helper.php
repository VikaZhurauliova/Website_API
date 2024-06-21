<?php

use App\Models\Domain;

if (!function_exists('getFrontUrl')) {
    function getFrontUrl(?string $url = '', ?Domain $domain = null): string
    {
        if (empty($url)) $url = '';
        if ($domain?->domain === 'localhost:3000') {
            $url = 'http://' . str_replace('//' , '/', $domain->domain . '/' . $url);
        } elseif (!empty($domain?->domain)) {
            $url = 'https://' . str_replace('//' , '/', $domain->domain . '/' . $url);
        }
        return $url;
    }
}

if (!function_exists('getAdminUrl')) {
    function getAdminUrl(?string $url = '', ?Domain $domain = null): string
    {
        return getFrontUrl('/admin' . (empty($domain->main) ? '/region' : '') . '/' . $url , $domain);
    }
}
