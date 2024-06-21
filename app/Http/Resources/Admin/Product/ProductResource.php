<?php

namespace App\Http\Resources\Admin\Product;

use App\Http\Resources\Admin\AuditResource;
use App\Services\Admin\AuditService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = parent::toArray($request);

        $productAudits = AuditService::getProductAudits($this->resource);
        $sizeAudits = AuditService::getSizeAudits($this->resource);
        $rentAudits = AuditService::getRentAudits($this->resource);
        $categoryAudits = AuditService::getCategoryAudits($this->resource);
        $badgeAudits = AuditService::getBadgeAudits($this->resource);
        $galleryAudits = AuditService::getGalleryAudits($this->resource);
        $paramsAudits = AuditService::getParamsAudits($this->resource);
        $qrCodeAudits = AuditService::getQrCodeAudits($this->resource);
        $colorAudits = AuditService::getColorAudits($this->resource);
        $seoAudits = AuditService::getSeoAudits($this->resource);

        // Преобразуем аудиты товара и размеров продукта в массивы
        $productAuditsArray = AuditResource::collection($productAudits)->toArray($request);
        $sizeAuditsArray = AuditResource::collection($sizeAudits)->toArray($request);
        $rentAuditsArray = AuditResource::collection($rentAudits)->toArray($request);
        $categoryAuditsArray = AuditResource::collection($categoryAudits)->toArray($request);
        $badgeAuditsArray = AuditResource::collection($badgeAudits)->toArray($request);
        $galleryAuditsArray = AuditResource::collection($galleryAudits)->toArray($request);
        $paramsAuditsArray = AuditResource::collection($paramsAudits)->toArray($request);
        $qrCodeAuditsArray = AuditResource::collection($qrCodeAudits)->toArray($request);
        $colorAuditsArray = AuditResource::collection($colorAudits)->toArray($request);
        $seoAuditsArray = AuditResource::collection($seoAudits)->toArray($request);

        // Объединяем аудиты товара и размеров продукта в один массив
        $data['audits'] = [
            'product' => $productAuditsArray,
            'size' => $sizeAuditsArray,
            'rent' => $rentAuditsArray,
            'category' => $categoryAuditsArray,
            'badge' => $badgeAuditsArray,
            'gallery' => $galleryAuditsArray,
            'params' => $paramsAuditsArray,
            'qrCode' => $qrCodeAuditsArray,
            'color' => $colorAuditsArray,
            'seo' => $seoAuditsArray,
        ];

        $colors = $this->colors->map(function ($color) {
            return [
                'id' => $color->id,
                'name' => $color->name,
                'code' => $color->code,
                'isImg' => !$color->is_code,
                'imgUrl' => $color->image,
            ];
        });

        $data['params'] = [
            'name' => $this->name,
            'model' => $this->model,
            'colors' => $colors,
            'techs' => $this->params->map(function ($param) {
                return [
                    'id' => $param->id,
                    'name' => $param->param->name,
                    'value' => $param->value,
                    'filters' => $param->filters->map(function ($filter) {
                        return [
                            'id' => $filter->id,
                            'name' => $filter->name
                        ];
                    })
                ];
            })
        ];

        $data['seo_url'] = $this->seo?->url;
        $data['seo_title'] = $this->seo?->title;
        $data['seo_keywords'] = $this->seo?->keywords;
        $data['seo_description'] = $this->seo?->description;

        return $data;
    }
}
