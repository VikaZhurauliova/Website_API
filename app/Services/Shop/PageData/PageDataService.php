<?php

namespace App\Services\Shop\PageData;

use App\Models\Domain;
use App\Models\Page;
use App\Models\PageRegion;
use App\Models\Seo;
use App\Models\SeoRegion;
use App\Services\QRCodeService;

class PageDataService
{
    public static function getPageData(string $url, string $lang): array
    {
        $return = [
            'data' => [
                'page_type' => null,
                'breadcrumbs' => [],
                'seo' => [
                    'meta' => []
                ],
                'content' => []
            ],
        ];
        $url = 'https://' . ltrim($url, '/');
        $arUrl = parse_url($url);
        $host = $arUrl['host'] ?? null;
        if (!empty($arUrl['port'])) $host = $arUrl['host'] . ':' . $arUrl['port'];
        $url = isset($arUrl['path']) ? trim($arUrl['path'], DIRECTORY_SEPARATOR) : '/';

        // Проверяем, обслуживается ли домен этим апи
        $domain = Domain::where('domain', $host)->first();

        if ($domain === null) return $return;

        return $return;
    }

    /**
     * @param array $return
     * @param Domain $domain
     * @return void
     */
    public static function setMainPageBreadcrumb(array &$return, Domain $domain): void
    {
        self::addBreadcrumb($return, 'Главная', getFrontUrl('/', $domain));
    }

    /**
     * @param array $return
     * @param string|null $name
     * @param string|null $link
     * @param Domain|null $domain
     * @return void
     */
    public static function addBreadcrumb(array &$return, ?string $name = null, ?string $link = null, ?Domain $domain = null): void
    {
        if ($name !== null) {
            $return['data']['breadcrumbs'][] = [
                'name' => $name,
                'link' => $link === null ? null : getFrontUrl($link, $domain),
            ];
        }
    }
}
