<?php

namespace App\Http\Requests\Traits;

use App\Services\DomainService;

trait SeoRegionRequestTrait
{
    protected function addSeoRegionFields(): void
    {
        $seoRegion = $this->seo_region;
        $seoRegion['url'] = $this->region_url ?? '/';
        $seoRegion['title'] = $this->region_title;
        $seoRegion['keywords'] = $this->region_keywords;
        $seoRegion['description'] = $this->region_description;
        if (isset($this->region_isPublished)) {
            $seoRegion['status'] = $this->region_isPublished ? 1 : null;
        } else {
            $seoRegion['status'] = 1;
        }
        if (!isset($this->seo_region['id'])) $seoRegion['id'] = null;
        if (!isset($seoRegion['domain_id'])) {
            $seoRegion['domain_id'] = DomainService::get($this->route('domain'))?->id;
        }
        if (!isset($this->seo_region['seo_id'])) $seoRegion['seo_id'] = null;
        $this->merge([
            'seoRegion' => $seoRegion
        ]);
    }

    protected function addSeoRegionRules(): array
    {
        return [
            'seoRegion' => 'required|array',
            'seoRegion.id' => 'nullable|integer',
            'seoRegion.status' => 'nullable|in:1',
            'seoRegion.url' => 'required|string|max:255|unique:seo_regions,url,' . $this->seoRegion['id'] . ',id,domain_id,' . $this->seoRegion['domain_id'],
            'seoRegion.title' => 'nullable|string|max:255',
            'seoRegion.keywords' => 'nullable|string|max:255',
            'seoRegion.description' => 'nullable|string|max:255',
        ];
    }
}
