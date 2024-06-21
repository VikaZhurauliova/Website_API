<?php

namespace App\Services;

use App\Models\Domain;
use App\Models\Seo;

class UrlService
{
    /**
     * @param Seo $seo
     * @return array
     */
    public static function getRevalidatePaths(Seo $seo): array
    {
        $paths = [];
        $seo->loadMissing('seoRegion');
        Domain::all()->each(function ($domain) use (&$paths, $seo) {
            $seoRegion = $seo->seoRegion()->where('domain_id', $domain->id)->first();
            $url = $seoRegion->url ?? $seo->url;
            $paths[] = DIRECTORY_SEPARATOR . $domain->domain . DIRECTORY_SEPARATOR . trim($url, DIRECTORY_SEPARATOR);
        });
        return $paths;
    }

}
