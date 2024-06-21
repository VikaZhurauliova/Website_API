<?php

return [
    'productGalleryFolder' => 'product_gallery', // Папка, в которой хранятся фото для галереи фото товаров
    'productPhotoSizes' => [376, 576, 768, 450, 900, 1080, 1440], // Размеры фото товаров
    'productPhotoQuality' => 80, // Качество, с которым сохраняются фото товаров

    'productLandingVideoFolder' => 'product_landing_video', // Папка, в которой хранятся видео для лендингов товаров

    'qrCodesFolder' => 'qr_codes', // Папка, в которой хранятся qr-коды
    'bannersFolder' => 'banners', // Папка, в которой хранятся фото для баннеров
    'bannerPreviewsFolder' => 'banners/previews', // Папка, в которой хранятся фото для баннеров
    'newsFolder' => 'news', // Папка, в которой хранятся фото для новостей

    'landingsUrl' => env('LANDINGS_URL', 'https://landing.market.ru/landings/'),
];
