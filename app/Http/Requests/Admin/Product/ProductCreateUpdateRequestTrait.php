<?php

namespace App\Http\Requests\Admin\Product;

use App\Http\Requests\Traits\SeoRequestTrait;

trait ProductCreateUpdateRequestTrait
{
    use SeoRequestTrait;

    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->addSeoFields();

        foreach (
            [
                'land_video_file_id_desktop',
                'land_video_file_id_mobile',
                'is_active_land_video_desktop',
                'is_active_land_video_mobile',
            ]
            as $prop) {
            if (empty($this->$prop)) {
                $this->merge([
                    $prop => null
                ]);
            }
        };

        $updatedCartGallery = [];
        if (!empty($this->cart_gallery) && count($this->cart_gallery)) {
            foreach ($this->cart_gallery as $cartGallery) {
                $cartGallery['id'] = $cartGallery['id'] ?? null;
                $cartGallery['is_active'] = $cartGallery['is_active'] ?? null;
                $cartGallery['photoNewFile'] = $cartGallery['photoNewFile'] ?? null;
                $cartGallery['video_search_text'] = $cartGallery['is_active'] ?? null;
                $cartGallery['video_instruction'] = $cartGallery['is_active'] ?? null;
                $cartGallery['video_stars'] = $cartGallery['is_active'] ?? null;
                $cartGallery['video_beauty_slide'] = $cartGallery['is_active'] ?? null;
                $updatedCartGallery[] = $cartGallery;
            }
        }

        $this->merge([
            'cart_gallery' => $updatedCartGallery
        ]);
    }

    protected function commonRules(): array
    {
        return array_merge($this->addSeoRules(), [
            'additional_products_basket' => 'nullable|array',
            'additional_products_basket.*.id' => 'required_with:additional_products_basket|integer|exists:products,id',

            'additional_products_landing' => 'nullable|array',
            'additional_products_landing.*.id' => 'required_with:additional_products_basket|integer|exists:products,id',

            'brand_id' => 'required_if:status_id,1|nullable|integer|exists:brands,id',

            'categories' => 'required_if:status_id,1|nullable|array',
            'categories.*.id' => 'required_with:categories|integer|exists:categories,id',

            'category_breadcrumbs_id' => 'required_if:status_id,1|nullable|integer|exists:categories,id',
            'category_compare_id' => 'required_if:status_id,1|nullable|integer|exists:categories,id',

            'isWithLanding' => 'nullable|in:1',
            'landingUrl' => 'nullable|string|max:255',

            'land_video_file_id_desktop' => 'nullable|integer|exists:files,id',
            'is_active_land_video_desktop' => 'nullable|in:1',
            'land_video_file_id_mobile' => 'nullable|integer|exists:files,id',
            'is_active_land_video_mobile' => 'nullable|in:1',

            'model' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'note' => 'nullable|string|max:255',
            'popularity' => 'nullable|integer',
            'price' => 'required_if:status_id,1|nullable|integer',
            'price_preorder' => 'nullable|integer',
            'price_promotion' => 'nullable|integer',

            'rent' => 'nullable|array',
            'rent.*.id' => 'nullable|integer|exists:product_rent,id',
            'rent.*.rent_id' => 'required_with:rent|integer|exists:rent_types,id',
            'rent.*.borboza_id' => 'required_with:rent|integer|exists:borboza_products,item_id',
            'rent.*.price' => 'nullable|integer',
            'rent.*.price_preorder' => 'nullable|integer',
            'rent.*.price_promotion' => 'nullable|integer',

            'short_name' => 'required_if:status_id,1|nullable|string|max:255',

            'size' => 'nullable|array',
            'size.*.id' => 'nullable|integer|exists:product_size,id',
            'size.*.size_id' => 'required_with:size|integer|exists:sizes,id',
            'size.*.price' => 'nullable|integer',
            'size.*.price_preorder' => 'nullable|integer',
            'size.*.price_promotion' => 'nullable|integer',

            'slogan_color' => 'nullable|string|max:50',
            'slogan_font_size' => 'nullable|string|max:50',
            'slogan_text' => 'nullable|string|max:255',
            'status_id' => 'required|integer|exists:product_statuses,id',
            'system_name' => 'required|string|max:255|unique:products,system_name,' . $this->id . ',id',
            'text_app' => 'nullable|string',
            'text_benefit' => 'nullable|string|max:255',
            'text_full' => 'nullable|string',
            'text_short' => 'nullable|string',

            'cart_gallery'=>'nullable|array',
            'cart_gallery.*.id' => 'nullable|integer|exists:product_gallery,id',
            'cart_gallery.*.type' => 'required|string|in:photo,video',
            'cart_gallery.*.photo_alt' => 'nullable|string|max:255',
            'cart_gallery.*.photo_title' => 'nullable|string|max:255',
            'cart_gallery.*.photo_is_feed' => 'nullable|boolean',
            'cart_gallery.*.is_active' => 'nullable|boolean',
            'cart_gallery.*.photoNewFile' => 'nullable|file|mimes:png',
            'cart_gallery.*.video_search_text' => 'nullable|boolean',
            'cart_gallery.*.video_description' => 'nullable|string',
            'cart_gallery.*.video_youtube_link' => 'nullable|string',
            'cart_gallery.*.video_instruction' => 'nullable|boolean',
            'cart_gallery.*.video_stars' => 'nullable|boolean',
            'cart_gallery.*.video_beauty_slide' => 'nullable|boolean',

            'params' => 'nullable|array',
            'params.colors' => 'nullable|array',
            'params.colors.*.id' => 'nullable|integer',
            'params.colors.*.name' => 'nullable|string',
            'params.colors.*.code' => 'nullable|string',
            'params.colors.*.isImg' => 'nullable|boolean',
            'params.colors.*.imgUrl' => 'nullable|string',

            'params.techs' => 'nullable|array',
            'params.techs.*.id' => 'nullable|integer',
            'params.techs.*.name' => 'nullable|string',
            'params.techs.*.value' => 'nullable|string',
            'params.techs.*.filters' => 'nullable|array',
            'params.techs.*.filters.*' => 'nullable|array',

        ]);
    }
}
