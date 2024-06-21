<?php

namespace App\Services\Shop\PageData;

use App\Models\Domain;
use App\Models\Page;
use App\Models\PageRegion;
use App\Models\Seo;
use Illuminate\Support\Str;

class EntityBuilder implements Builder
{
    public function getEntityName(object $entity): string
    {
        return Str::snake(class_basename($entity));
    }

    public function setPageData(string $urn, mixed $data, array &$return, Domain $domain, $lang): void
    {
        $this->setPageType($urn, $data, $return);
        $this->addSeo($urn, $data, $return, $domain);
        $this->addBreadCrumbs($urn, $data, $return, $lang, $domain);
        $this->addPageData($urn, $data, $return, $domain);
        $this->addAdminLink($data, $return, $domain);
    }

    public static function setAllPageData(string $urn, mixed $data, array &$return, Domain $domain, string $lang): void
    {
        if ($data instanceof (Seo::class)) {
            $builder = new self;
            $entity = $data->seoble;
            if ($entity !== null) {
                $pageClassFull = get_class($entity);
                switch ($pageClassFull) {
                    case 'App\\Models\\Product':
                        $builder = new ProductBuilder();
                        break;
                    case 'App\\Models\\Category':
                        $builder = new CategoryBuilder();
                        break;
                    case 'App\\Models\\Page':
                        $page = $data->seoble;
                        $region = PageRegion::where('page_id', $data->seoble->id)->where('domain_id', $domain->id)->first();
                        if ($region !== null) $data->seoble = $region;
                        $builder = match ($data->seoble->template_id) {
                            1 => new ServicePageBuilder(),
                            2 => new CatalogBuilder(),
                            3 => new SaleBuilder(),
                            4 => new NewsListBuilder(),
                            5 => new MainPageBuilder(),
                            default => new ServicePageBuilder(),
                        };
                        break;
                }
            }
            $builder->setPageData($urn, $data, $return, $domain, $lang);
        }
    }
    public function setPageType(string $urn, mixed $data, array &$return): void
    {
        if (is_object($data?->seoble)) {
            $return['data']['page_type'] = $this->getEntityName($data->seoble);
        } else {
            $return['data']['page_type'] = Str::snake(trim($urn,'/'));
        }
    }

    public function addSeo(string $urn, mixed $data, array &$return, Domain $domain): void
    {
        if ($data instanceof (Seo::class)) {
            $return['data']['seo']['title'] = $data->title;
            $return['data']['seo']['canonical'] = getFrontUrl($data->url, $domain);
            $return['data']['seo']['meta'][] = [
                'name' => 'keywords',
                'content' => $data->keywords
            ];
            $return['data']['seo']['meta'][] = [
                'name' => 'description',
                'content' => $data->description
            ];
            $data->seoMeta->each(function($meta) use (&$return) {
                $return['data']['seo']['meta'][] = [
                    'name' => $meta->name,
                    'content' => $meta->content,
                    'http_equiv' => $meta->http_equiv,
                    'property' => $meta->property,
                ];
            });
        }
    }

    public function addBreadCrumbs(string $urn, mixed $data, array &$return, string $lang, Domain $domain): void
    {
        //
    }

    public function addCatalogBreadCrumb(array &$return, string $lang, Domain $domain): void
    {
        $return['data']['breadcrumbs'][] = [
            'name' => translate('Каталог', $lang),
            'link' => Page::find(7)->seo_url($domain)
        ];
    }

    public function addPageData(string $urn, mixed $data, array &$return, Domain $domain): void
    {
        if (is_object($data?->seoble)) $return['data'][$this->getEntityName($data->seoble)] = $data->seoble->toArray();
    }

    public function addAdminLink(mixed $data, array &$return, Domain $domain): void
    {
        $return['data']['adminLink'] = null;
    }
}
