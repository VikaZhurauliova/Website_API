<?php

namespace App\Services\Shop\PageData;

use App\Models\Category;
use App\Models\Domain;
use App\Models\News;
use App\Models\PageTemplate;

class NewsListBuilder extends EntityBuilder implements Builder
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
        $newsList = News::where('status', 1)
            ->orderBy('created_at', 'desc')->with(['seo' => function($query) {
                $query->select('url', 'seoble_id');
            }])
            ->select('id', 'title', 'image_alt', 'image_src')
            ->get();

        $return['data']['content']['page'] = [
            'id' => $data->seoble->id,
            'name' => $data->seoble->name,
            'newsList' => $newsList,
        ];
    }

    public function setPageType(string $urn, mixed $data, array &$return): void
    {
        $return['data']['page_type'] = PageTemplate::find(4)->name;
    }

    public function addAdminLink(mixed $data, array &$return, Domain $domain): void
    {
        $return['data']['adminLink'] = getAdminUrl('pages/' . $data->seoble_id, $domain);
    }

}
