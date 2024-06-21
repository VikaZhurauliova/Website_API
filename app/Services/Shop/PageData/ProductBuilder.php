<?php

namespace App\Services\Shop\PageData;

use App\Http\Resources\Admin\Product\ProductResource;
use App\Models\Domain;
use App\Models\Page;
use App\Models\Product;

class ProductBuilder extends EntityBuilder implements Builder
{

    public function addBreadCrumbs(string $urn, mixed $data, array &$return, $lang, Domain $domain): void
    {
        PageDataService::setMainPageBreadcrumb($return, $domain);
        $this->addCatalogBreadCrumb($return, $lang, $domain);
        $product = $data?->seoble;
        if ($product instanceof (Product::class)) {
            if ($product->categoryBreadcrumbs?->parent !== null) {
                PageDataService::addBreadcrumb($return, $product->categoryBreadcrumbs->parent->getCategoryName($domain), $product->categoryBreadcrumbs->parent->seo_url($domain));
            }
            PageDataService::addBreadcrumb($return, $product->categoryBreadcrumbs?->getCategoryName($domain), $product->categoryBreadcrumbs?->seo_url($domain));
            PageDataService::addBreadcrumb($return, strip_tags($product->name));
        }
    }

    public function addSeo(string $urn, mixed $data, array &$return, Domain $domain): void
    {
        parent::addSeo($urn, $data, $return, $domain);
        $product = $data?->seoble;
        if ($product instanceof (Product::class)) {
            $return['data']['seo']['meta'][] = [
                'property' => 'ya:type',
                'content' => 'one_product'
            ];
            if ($product->photo !== null) {
                $return['data']['seo']['meta'][] = [
                    'property' => 'og:image',
                    'content' => $product->photo
                ];
            }
        }
    }

    public function addPageData(string $urn, mixed $data, array &$return, Domain $domain): void
    {
        // Данные товара
        $product = $data?->seoble;
        if ($product instanceof (Product::class)) {
            $product->loadMissing([
                'brand',
                'landVideoDesktop',
                'landVideoMobile',
                'status',
                'categoryCompare',
                'badges',
                'categories',
                'params',
                'rent',
                'size',
                'additionalProductsLanding',
                'additionalProductsBasket',
                'gallery',
            ]);

            $productRegion = $product->productRegion($domain);
            if (isset($productRegion->name)) {
                $product->name = $productRegion->name;
                $product->model = $productRegion->model;
                $product->short_name = $productRegion->short_name;
                $product->text_short = $productRegion->text_short;
                $product->text_full = $productRegion->text_full;
                $product->isWithLanding = $productRegion->isWithLanding;
                $product->landingUrl = $productRegion->landingUrl;
            }

            if (!empty($product->isWithLanding)) {
                try {
                    $return['data']['content']['landing'] = str_replace('http:/', 'https:/',
                        $product->landingUrl ?? file_get_contents(rtrim($product->landingUrl, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR. 'index.html')
                    );
                } catch (\Exception $e) {
                    $return['data']['content']['landing'] = null;
                }
            } else {
                $return['data']['content']['landing'] = null;
            }

            $return['data']['content']['product'] = array_merge($product->toArray(), [
                'storageStatus' => $product->storageStatus,
                'rassrochka' => ($product->storageStatus['code'] === 'avail' && $product->sort_price > 10000) ?
                    [
                        'price' => round($product->sort_price / 24),
                        'href' => Page::with('seo.seoRegion')->find(22)->seo_url($domain)
                    ] :
                    null
            ]);
        }
    }

    // Проверяем товар на доступность пользователю
    public function setPageData(string $urn, mixed $data, array &$return, Domain $domain, $lang): void
    {
        $product = $data?->seoble;
        if ($product instanceof (Product::class)) {
            $user = auth()->user();
            if ($product->status_id !== 2 || ($user !== null && $user->can('use_admin_panel'))) {
                parent::setPageData($urn, $data, $return, $domain, $lang);
            }
        }
    }

    public function addAdminLink(mixed $data, array &$return, Domain $domain): void
    {
        $return['data']['adminLink'] = getAdminUrl('products/' . $data->seoble_id, $domain);
    }

}
