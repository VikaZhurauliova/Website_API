<?php

namespace App\Http\Controllers\Swagger\Schemas;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "ProductGallerySchema",
    title: "Галерея фото и видео товаров",
    required: ["id", "product_id", "type", "sort", "photo_file_name_orig", "photos"],
    properties: [
        new OA\Property(property: "id", type: "integer", example: 138),
        new OA\Property(property: "product_id", description: "ID товара", type: "integer", example: 12, nullable: true),
        new OA\Property(property: "type", description: "Тип: фото или видео", type: "string", enum: ["photo", "video"]),
        new OA\Property(property: "is_active", description: "Опубликовано", type: "integer", example: 1, nullable: true),
        new OA\Property(property: "sort", description: "Сортировка", type: "integer", example: 1, nullable: true),
        new OA\Property(property: "photo_file_name_orig", description: "Название оригинального файла фото (соответствует техническому наименованию товара)", type: "string", example: "market-xi.png"),
        new OA\Property(property: "photo_title", description: "Заголовок (фото)", type: "string", example: "Массажное кресло нового поколения market Xi "),
        new OA\Property(property: "photo_alt", description: "Подзаголовок (фото)", type: "string", example: "Массажное кресло нового поколения market Xi"),
        new OA\Property(property: "photo_is_feed", description: "Рекламный фид (фото)", type: "integer", example: 1, nullable: true),
        new OA\Property(property: "video_youtube_link", description: "Ссылка на видео на YouTube (видео)", type: "string", example: "https://www.youtube.com/embed/w0YWLLXfgzY?dfefrel=0"),
        new OA\Property(property: "video_search_text", description: "Текст для поиска (видео)", type: "string", example: "тренажер"),
        new OA\Property(property: "video_description", description: "Описание (видео)", type: "string", example: "тренажер"),
        new OA\Property(property: "video_instruction", description: "Инструкция (видео)", type: "integer", example: 1, nullable: true),
        new OA\Property(property: "video_stars", description: "Звёзды (видео)", type: "integer", example: 1, nullable: true),
        new OA\Property(property: "video_beauty_slide", description: "Бьюти слайд (видео)", type: "integer", example: 1, nullable: true),
        new OA\Property(
            property: "photos",
            description: "Фото разных размеров",
            required: ["default", "original"],
            properties: [
                new OA\Property(property: "376", description: "Размер 376px", type: "string", example: "https://market.ru/storage/product_gallery/3/376/qwer.webp"),
                new OA\Property(property: "450", description: "Размер 450px", type: "string", example: "https://market.ru/storage/product_gallery/3/450/qwer.webp"),
                new OA\Property(property: "576", description: "Размер 576px", type: "string", example: "https://market.ru/storage/product_gallery/3/576/qwer.webp"),
                new OA\Property(property: "768", description: "Размер 768px", type: "string", example: "https://market.ru/storage/product_gallery/3/768/qwer.webp"),
                new OA\Property(property: "900", description: "Размер 900px", type: "string", example: "https://market.ru/storage/product_gallery/3/900/qwer.webp"),
                new OA\Property(property: "1080", description: "Размер 1080px", type: "string", example: "https://market.ru/storage/product_gallery/3/1080/qwer.webp"),
                new OA\Property(property: "1440", description: "Размер 1440px", type: "string", example: "https://market.ru/storage/product_gallery/3/1440/qwer.webp"),
                new OA\Property(property: "default", description: "Размер как у оригинала", type: "string", example: "https://market.ru/storage/product_gallery/3/default/qwer.webp"),
                new OA\Property(property: "original", description: "Оригинал", type: "string", example: "https://market.ru/storage/product_gallery/3/original/qwer.webp")
            ],
            type: "object",
            nullable: true
        )
    ]
)]
class ProductGallerySchema
{

}
