<?php
namespace App\Services\Admin;

use App\Models\Product;
use App\Models\Audit;

class AuditService
{
    /**
     * @param Product $product
     * @return mixed
     */
    public static function getProductAudits(Product $product)
    {
        return Audit::where('auditable_type', 'App\\Models\\Product')
            ->where('auditable_id', $product->id)
            ->get();
    }

    /**
     * @param Product $product
     * @return mixed
     */
    public static function getSizeAudits(Product $product)
    {
        return Audit::where('auditable_type', 'App\\Models\\ProductSize')
            ->whereIn('auditable_id', function($query) use ($product) {
                $query->select('id')
                    ->from('product_size')
                    ->where('product_id', $product->id);
            })
            ->get();
    }

    /**
     * @param Product $product
     * @return mixed
     */
    public static function getRentAudits(Product $product)
    {
        return Audit::where('auditable_type', 'App\\Models\\ProductRent')
            ->whereIn('auditable_id', function($query) use ($product) {
                $query->select('id')
                    ->from('product_rent')
                    ->where('product_id', $product->id);
            })
            ->get();
    }

    /**
     * @param Product $product
     * @return mixed
     */
    public static function getCategoryAudits(Product $product)
    {
        return Audit::where('auditable_type', 'App\\Models\\Category')
            ->whereIn('auditable_id', function($query) use ($product) {
                $query->select('id')
                    ->from('product_category')
                    ->where('product_id', $product->id);
            })
            ->get();
    }

    /**
     * @param Product $product
     * @return mixed
     */
    public static function getBadgeAudits(Product $product)
    {
        return Audit::where('auditable_type', 'App\\Models\\ProductBadge')
            ->whereIn('auditable_id', function($query) use ($product) {
                $query->select('id')
                    ->from('product_badge')
                    ->where('product_id', $product->id);
            })
            ->get();
    }

    /**
     * @param Product $product
     * @return mixed
     */
    public static function getGalleryAudits(Product $product)
    {
        return Audit::where('auditable_type', 'App\\Models\\ProductGallery')
            ->whereIn('auditable_id', function($query) use ($product) {
                $query->select('id')
                    ->from('product_gallery')
                    ->where('product_id', $product->id);
            })
            ->get();
    }

    /**
     * @param Product $product
     * @return mixed
     */
    public static function getParamsAudits(Product $product)
    {
        return Audit::where('auditable_type', 'App\\Models\\ProductGallery')
            ->whereIn('auditable_id', function($query) use ($product) {
                $query->select('id')
                    ->from('product_params')
                    ->where('product_id', $product->id);
            })
            ->get();
    }

    /**
     * @param Product $product
     * @return mixed
     */
    public static function getQrCodeAudits(Product $product)
    {
        return Audit::where('auditable_type', 'App\\Models\\QRCode')
            ->whereIn('auditable_id', function($query) use ($product) {
                $query->select('id')
                    ->from('qr_codes')
                    ->where('product_id', $product->id);
            })
            ->get();
    }

    /**
     * @param Product $product
     * @return mixed
     */
    public static function getColorAudits(Product $product)
    {
        return Audit::where('auditable_type', 'App\\Models\\Color')
            ->whereIn('auditable_id', function($query) use ($product) {
                $query->select('id')
                    ->from('product_colors')
                    ->where('product_id', $product->id);
            })
            ->get();
    }

    /**
     * @param Product $product
     * @return mixed
     */
    public static function getSeoAudits(Product $product)
    {
        return Audit::where('auditable_type', 'App\\Models\\Seo')
            ->whereIn('auditable_id', function($query) use ($product) {
                $query->select('id')
                    ->from('seo')
                    ->where('seoble_type', 'App\Models\Product')
                    ->where('seoble_id', $product->id);
            })
            ->get();
    }
}
