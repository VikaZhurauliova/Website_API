<?php

namespace App\Http\Controllers\Swagger\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "ProductSchema",
    title: "Товар",
    required: ["data"],
    properties: [
        new OA\Property(
            property: "data",
            required: [
                "id",
                "price",
                "price_promotion",
                "price_preorder",
                "name",
                "slogan_text",
                "slogan_font_size",
                "slogan_color",
                "brand_id",
                "model",
                "short_name",
                "seo_url",
                "popularity",
                "status_id",
                "note",
                "isWithLanding",
                "landingUrl",
                "land_video_file_id_desktop",
                "is_active_land_video_desktop",
                "land_video_file_id_mobile",
                "is_active_land_video_mobile",
                "category_compare_id",
                "text_short",
                "text_full",
                "text_app",
                "text_benefit",
                "category_breadcrumbs_id",
                "category_feed_id",
                "created_at",
                "updated_at",
                "deleted_at",
                "brand",
                "land_video_desktop",
                "land_video_mobile",
                "status",
                "category_compare",
                "categories",
                "params",
                "rent",
                "size",
                "additional_products_landing",
                "additional_products_basket",
                "gallery",
                "audits",
                "qnt",
                "seo_title",
                "seo_keywords",
                "seo_description",
            ],
            properties: [
                new OA\Property(property: "id", type: "integer", example: 331),
                new OA\Property(property: "price", description: "Цена", type: "integer", example: 1900, nullable: true),
                new OA\Property(property: "price_promotion", description: "Цена по акции", type: "integer", example: 1900, nullable: true),
                new OA\Property(property: "price_preorder", description: "Цена предзаказа", type: "integer", example: 1900, nullable: true),
                new OA\Property(property: "name", description: "Название товара", type: "string", example: "market", nullable: true),
                new OA\Property(property: "slogan_text", description: "Слоган", type: "string", example: "Надежная защита и поддержка", nullable: true),
                new OA\Property(property: "slogan_font_size", description: "Размер шрифта слогана", type: "string", example: "30", nullable: true),
                new OA\Property(property: "slogan_color", description: "Код цвета слогана", type: "string", example: "30", nullable: true),
                new OA\Property(property: "brand_id", description: "ID бренда", type: "integer", example: 3, nullable: true),
                new OA\Property(property: "model", description: "Модель", type: "string", example: "Aeroprene Elbow Support", nullable: true),
                new OA\Property(property: "short_name", description: "Короткое название", type: "string", example: "Бандаж на локтевой сустав", nullable: true),
                new OA\Property(property: "popularity", description: "Популярность", type: "integer", example: 12, nullable: true),
                new OA\Property(property: "status_id", description: "ID статуса", type: "integer", example: 1, nullable: true),
                new OA\Property(property: "isWithLanding", description: "Использовать лендинг", type: "bool", example: true),
                new OA\Property(property: "landingUrl", description: "URL лендинга", type: "string", example: "https://market.ru/landings/ab-new", nullable: true),
                new OA\Property(property: "land_video_file_id_desktop", description: "ID видео десктоп в лендинге", type: "integer", example: 333, nullable: true),
                new OA\Property(property: "is_active_land_video_desktop", description: "Видео десктоп в лендинге активно", type: "integer", example: 1, nullable: true),
                new OA\Property(property: "land_video_file_id_mobile", description: "ID видео мобайл в лендинге", type: "integer", example: 333, nullable: true),
                new OA\Property(property: "is_active_land_video_mobile", description: "Видео мобайл в лендинге активно", type: "integer", example: 1, nullable: true),
                new OA\Property(property: "text_short", description: "Короткое описание (фид для Яндекс)", type: "string", example: "<p>Бандаж на локтевой сустав </p>", nullable: true),
                new OA\Property(property: "text_full", description: "Полное описание (если лендинга нет — выводится это описание)", type: "string", example: "<p>Бандаж на локтевой сустав </p>", nullable: true),
                new OA\Property(property: "text_app", description: "Описание для приложения", type: "string", example: "<<p>Бандаж на локтевой сустав </p>", nullable: true),
                new OA\Property(property: "text_benefit", description: "Фраза о выгоде в год", type: "string", example: "<p>Бандаж на локтевой сустав </p>", nullable: true),
                new OA\Property(property: "category_breadcrumbs_id", description: "ID категории для хлебных крошек", type: "integer", example: 137, nullable: true),
                new OA\Property(property: "created_at", description: "Дата создания товара", type: "string", example: "2022-03-21T17:07:02.000000Z", nullable: true),
                new OA\Property(property: "updated_at", description: "Дата обновления товара", type: "string", example: "2023-11-01T01:00:21.000000Z", nullable: true),
                new OA\Property(property: "deleted_at", description: "Дата удаления товара (soft delete)", type: "string", example: "2023-11-01T01:00:21.000000Z", nullable: true),
                new OA\Property(property: "brand", description: "Бренд", properties: [
                    new OA\Property(property: "id", type: "integer", example: 3),
                    new OA\Property(property: "name", description: "Название бренда", type: "string", example: "Market", nullable: true),
                    new OA\Property(property: "sort", description: "Сортировка", type: "integer", example: 1, nullable: true),
                    new OA\Property(property: "created_at", description: "Дата создания", type: "string", example: "2022-03-21T17:07:02.000000Z", nullable: true),
                    new OA\Property(property: "updated_at", description: "Дата обновления", type: "string", example: "2022-03-21T17:07:02.000000Z", nullable: true),
                ],  type: "object",
                    nullable: true
                ),
                new OA\Property(property: "land_video_desktop", description: "Видео десктоп в лендинге", properties: [
                    new OA\Property(property: "id", type: "integer", example: 3),
                    new OA\Property(property: "src", description: "Путь к загруженному файлу", type: "string", example: "", nullable: true),
                    new OA\Property(property: "type", description: "Тип файла условный", type: "string", example: "", nullable: true),
                    new OA\Property(property: "name_init", description: "Изначальное имя файла", type: "string", example: "", nullable: true),
                    new OA\Property(property: "width", description: "Ширина для фото или видео", type: "integer", example: 1, nullable: true),
                    new OA\Property(property: "height", description: "Высота для фото или видео", type: "integer", example: 1, nullable: true),
                    new OA\Property(property: "preview", description: "Путь к превью", type: "string", example: "", nullable: true),
                    new OA\Property(property: "created_at", description: "Дата создания", type: "string", example: "2022-03-21T17:07:02.000000Z", nullable: true),
                    new OA\Property(property: "updated_at", description: "Дата обновления", type: "string", example: "2022-03-21T17:07:02.000000Z", nullable: true),
                ],  type: "object",
                    nullable: true
                ),
                new OA\Property(property: "land_video_mobile", description: "Видео мобильного устройства в лендинге", properties: [
                    new OA\Property(property: "id", type: "integer", example: 3),
                    new OA\Property(property: "src", description: "Путь к загруженному файлу", type: "string", example: "", nullable: true),
                    new OA\Property(property: "type", description: "Тип файла условный", type: "string", example: "", nullable: true),
                    new OA\Property(property: "name_init", description: "Изначальное имя файла", type: "string", example: "", nullable: true),
                    new OA\Property(property: "width", description: "Ширина для фото или видео", type: "integer", example: 1, nullable: true),
                    new OA\Property(property: "height", description: "Высота для фото или видео", type: "integer", example: 1, nullable: true),
                    new OA\Property(property: "preview", description: "Путь к превью", type: "string", example: "", nullable: true),
                    new OA\Property(property: "created_at", description: "Дата создания", type: "string", example: "2022-03-21T17:07:02.000000Z", nullable: true),
                    new OA\Property(property: "updated_at", description: "Дата обновления", type: "string", example: "2022-03-21T17:07:02.000000Z", nullable: true),
                ],  type: "object",
                    nullable: true
                ),
                new OA\Property(property: "status", description: "Статусы товара", properties: [
                    new OA\Property(property: "id", type: "integer", example: 3),
                    new OA\Property(property: "name", description: "Название статуса", type: "string", example: "Опубликован", nullable: true),
                    new OA\Property(property: "description", description: "Описание статуса", type: "string", example: "Виден в поиске сайта, в каталогах и доступен для поисковиков", nullable: true),
                    new OA\Property(property: "created_at", description: "Дата создания", type: "string", example: "2022-03-21T17:07:02.000000Z", nullable: true),
                    new OA\Property(property: "updated_at", description: "Дата обновления", type: "string", example: "2022-03-21T17:07:02.000000Z", nullable: true),
                ],  type: "object",
                    nullable: true
                ),
                new OA\Property(property: "badges", description: "Бейджи", properties: [
                    new OA\Property(property: "id", type: "integer", example: 4),
                    new OA\Property(property: "group_id", description: "ID группы", type: "integer", example: 12, nullable: true),
                    new OA\Property(property: "text", description: "Текст", type: "string", example: "Укрепи дружбу", nullable: true),
                    new OA\Property(property: "is_active", description: "Активен ли бейдж", type: "integer", example: 1, nullable: true),
                ],  type: "object",
                    nullable: true
                ),
                new OA\Property(property: "categories", description: "Категории товара", type: "array",
                    items: new OA\Items(
                        properties: [
                            new OA\Property(property: "id", type: "integer", example: 138),
                            new OA\Property(property: "parent_id", description: "ID родительской категории", type: "integer", example: 12, nullable: true),
                            new OA\Property(property: "name", description: "Название категории", type: "string", example: "Беговые дорожки и фитнес", nullable: true),
                            new OA\Property(property: "sort", description: "Сортировка", type: "integer", example: 1, nullable: true),
                            new OA\Property(property: "created_at", description: "Дата создания", type: "string", example: "2022-03-21T17:07:02.000000Z", nullable: true),
                            new OA\Property(property: "updated_at", description: "Дата обновления", type: "string", example: "2023-11-01T01:00:21.000000Z", nullable: true),
                            new OA\Property(property: "deleted_at", description: "Дата удаления (soft delete)", type: "string", example: "2023-11-01T01:00:21.000000Z", nullable: true),
                        ]
                    )
                ),
                new OA\Property(
                    property: "params",
                    description: "Параметры товара",
                    required: ['name', 'model', 'colors', 'techs'],
                    properties: [
                        new OA\Property(property: "name", description: "Название товара", type: "string", example: "market"),
                        new OA\Property(property: "model", description: "Модель товара", type: "string", example: "market"),
                        new OA\Property(property: "colors", description: "Цвета", type: "array", items: new OA\Items(
                            required: ['id', 'name', 'code', 'isImg', 'imgUrl'],
                            properties: [
                                new OA\Property(property: "id", type: "integer", example: 138),
                                new OA\Property(property: "name", description: "Название цвета", type: "string", example: "Красный"),
                                new OA\Property(property: "code", description: "Код цвета", type: "string", example: "#ffffff"),
                                new OA\Property(property: "isImg", description: "Это картинка", type: "bool", example: false),
                                new OA\Property(property: "imgUrl", description: "Url картинки", type: "string", example: "http..."),
                            ]
                        )),
                        new OA\Property(property: "techs", description: "Характеристики", type: "array", items: new OA\Items(
                            required: ['id', 'name', 'value', 'filters'],
                            properties: [
                                new OA\Property(property: "id", type: "integer", example: 138),
                                new OA\Property(property: "name", description: "Название параметра", type: "string", example: "Гарантия"),
                                new OA\Property(property: "value", description: "Значение параметра", type: "string", example: "3 года"),
                                new OA\Property(property: "filters", description: "Фильтры", type: "array", items: new OA\Items(
                                    required: ['id', 'name'],
                                    properties: [
                                        new OA\Property(property: "id", type: "integer", example: 138),
                                        new OA\Property(property: "name", description: "Название фильтра", type: "string", example: "Гарантия"),
                                    ]
                                )),
                            ]
                        )),
                    ],
                    type: "object"
                ),
                new OA\Property(property: "rent", description: "Варианты аренды товара", type: "array",
                    items: new OA\Items(
                        properties: [
                            new OA\Property(property: "id", type: "integer", example: 138),
                            new OA\Property(property: "product_id", description: "ID товара", type: "integer", example: 95, nullable: true),
                            new OA\Property(property: "rent_id", type: "integer", example: 95, nullable: true),
                            new OA\Property(property: "borboza_id", type: "integer", example: 95, nullable: true),
                            new OA\Property(property: "price", description: "Цена", type: "integer", example: 95, nullable: true),
                            new OA\Property(property: "price_promotion", description: "Цена по акции", type: "integer", example: 95, nullable: true),
                            new OA\Property(property: "price_preorder", description: "Цена предзаказа", type: "integer", example: 95, nullable: true),
                            new OA\Property(property: "rent", description: "Вариант аренды", properties: [
                                new OA\Property(property: "id", type: "integer", example: 3),
                                new OA\Property(property: "name", description: "Название типа аренды", type: "string", example: "Аренда на 1 месяц", nullable: true),
                                new OA\Property(property: "sort", description: "Сортировка", type: "integer", example: 1, nullable: true),
                            ], type: "object",
                                nullable: true
                            )
                        ]
                    )
                ),
                new OA\Property(property: "size", description: "Размеры", type: "array",
                    items: new OA\Items(
                        properties: [
                            new OA\Property(property: "id", type: "integer", example: 138),
                            new OA\Property(property: "product_id", description: "ID товара", type: "integer", example: 95, nullable: true),
                            new OA\Property(property: "size_id", description: "", type: "integer", example: 95, nullable: true),
                            new OA\Property(property: "borboza_id", description: "", type: "integer", example: 95, nullable: true),
                            new OA\Property(property: "price", description: "Цена", type: "integer", example: 95, nullable: true),
                            new OA\Property(property: "price_promotion", description: "Цена по акции", type: "integer", example: 95, nullable: true),
                            new OA\Property(property: "price_preorder", description: "Цена предзаказа", type: "integer", example: 95, nullable: true),
                            new OA\Property(property: "size", description: "Размер", properties: [
                                new OA\Property(property: "id", type: "integer", example: 3),
                                new OA\Property(property: "name", description: "Название размера", type: "string", example: "S", nullable: true),
                                new OA\Property(property: "sort", description: "Сортировка", type: "integer", example: 1, nullable: true),
                            ], type: "object",
                                nullable: true
                            )
                        ]
                    )
                ),
                new OA\Property(property: "additional_products_landing", description: "С этим товаром покупают на лендинге", type: "array",
                    items: new OA\Items(
                        properties: [
                            new OA\Property(property: "id", type: "integer", example: 138),
                            new OA\Property(property: "borboza_id", description: "", type: "integer", example: 95, nullable: true),
                            new OA\Property(property: "price", description: "Цена", type: "integer", example: 95, nullable: true),
                            new OA\Property(property: "price_promotion", description: "Цена по акции", type: "integer", example: 95, nullable: true),
                            new OA\Property(property: "price_preorder", description: "Цена предзаказа", type: "integer", example: 95, nullable: true),
                        ]
                    )
                ),
                new OA\Property(property: "additional_products_basket", description: "С этим товаром покупают в корзине", type: "array",
                    items: new OA\Items(
                        properties: [
                            new OA\Property(property: "id", type: "integer", example: 138),
                            new OA\Property(property: "borboza_id", description: "", type: "integer", example: 95, nullable: true),
                            new OA\Property(property: "price", description: "Цена", type: "integer", example: 95, nullable: true),
                            new OA\Property(property: "price_promotion", description: "Цена по акции", type: "integer", example: 95, nullable: true),
                            new OA\Property(property: "price_preorder", description: "Цена предзаказа", type: "integer", example: 95, nullable: true),
                        ]
                    )
                ),
                new OA\Property(property: "gallery", description: "Галерея фото и видео товаров", type: "array",
                    items: new OA\Items(
                        allOf: [
                            new OA\Schema(ref: "#/components/schemas/ProductGallerySchema"),
                        ]
                    )
                ),
                new OA\Property(property: "audits", description: "История изменений", type: "array",
                    items: new OA\Items(
                        allOf: [
                            new OA\Schema(ref: "#/components/schemas/AuditSchema"),
                        ]
                    )
                ),
                new OA\Property(property: "seo_url", description: "Адрес страницы", type: "string", example: "products/market", nullable: true),
                new OA\Property(property: "seo_title", description: "Заголовок страницы", type: "string", example: "накидка", nullable: true),
                new OA\Property(property: "seo_keywords", description: "Ключевые слова", type: "string", example: "накидки", nullable: true),
                new OA\Property(property: "seo_description", description: "Описание страницы", type: "string", nullable: true),
            ],
            type: "object"
        )
    ]
)]

class ProductSchema
{

}
