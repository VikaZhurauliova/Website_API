<?php

namespace App\Services\Shop\PageData;

use App\Models\Domain;
use App\Models\Page;
use App\Models\PageRegion;
use App\Models\PageTemplate;

class ServicePageBuilder extends EntityBuilder implements Builder
{

    /**
     * @param string $urn
     * @param mixed $data
     * @param array $return
     * @param Domain $domain
     * @return void
     */
    public function addPageData(string $urn, mixed $data, array &$return, Domain $domain): void
    {
        $page = $data->seoble;
        $return['data']['content']['page']['id'] = $page->id;
        $return['data']['content']['page']['name'] = $page->name;
        if ($page->isWithLanding && !empty($page->landing_url)) {
            try {
                $return['data']['content']['page']['body'] = str_replace('http:/', 'https:/',
                    file_get_contents(rtrim($page->landing_url, '/') . '/index.html')
                );
            } catch (\Exception $e) {
                $return['data']['content']['page']['body'] = $page->body;
            }
        } else {
            $return['data']['content']['page']['body'] = $page->body;
        }
        $return['data']['content']['page']['isWithForm'] = boolval($page->isWithForm);
    }

    public function setPageType(string $urn, mixed $data, array &$return): void
    {
        $return['data']['page_type'] = PageTemplate::find(1)->name;
    }

    public function addAdminLink(mixed $data, array &$return, Domain $domain): void
    {
        $return['data']['adminLink'] = getAdminUrl('pages/' . $data->seoble_id, $domain);
    }

}
