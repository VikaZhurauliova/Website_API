<?php

namespace App\Models\Traits;

use App\Models\Domain;
use App\Models\Seo;
use App\Models\SeoRegion;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait SeobleTrait
{
    /**
     * SEO
     * @return MorphOne
     */
    public function seo(): MorphOne
    {
        return $this->morphOne(Seo::class, 'seoble');
    }

    /**
     * Адрес страницы
     */
    public function seo_url(?Domain $domain = null): string|null
    {
        $seoRegion = $this->seoRegionForDomain($domain);
        $url = $seoRegion ? $seoRegion->url : $this->seo?->url;
        return getFrontUrl($url, $domain);
    }

    /**
     * Заголовок страницы (seo_title)
     */
    public function seo_title(?Domain $domain = null): string|null
    {
        $seoRegion = $this->seoRegionForDomain($domain);
        return $seoRegion ? $seoRegion->title : $this->seo?->title;
    }

    /**
     * Ключевые слова (seo_keywords)
     */
    public function seo_keywords(?Domain $domain = null): string|null
    {
        $seoRegion = $this->seoRegionForDomain($domain);
        return $seoRegion ? $seoRegion->keywords : $this->seo?->keywords;
    }

    /**
     * Ключевые слова (seo_description)
     */
    public function seo_description(?Domain $domain = null): string|null
    {
        $seoRegion = $this->seoRegionForDomain($domain);
        return $seoRegion ? $seoRegion->description : $this->seo?->description;
    }

}
