<?php

namespace App\Http\Controllers\Swagger\Admin;

use App\Http\Controllers\Controller;
use OpenApi\Attributes as OA;


#[OA\Tag(
    name:"Admin / Product",
    description:"Админка / Товары"
)]

#[OA\Get(
    path: "/api/admin/products/schema",
    summary: "Список товаров",
    security: [["bearerAuth" => []]],
    tags: ["Admin / Product"],
    responses: [
        new OA\Response(
            response: 200,
            description: "Ok",
            content: new OA\JsonContent(
                allOf: [
                    new OA\Schema(
                        title: "ProductList",
                        required: ["data"],
                        properties: [
                            new OA\Property(
                                property: "data",
                                type: "array",
                                items: new OA\Items(
                                    required: [
                                        "id",
                                        "name",
                                        "site_url",
                                        "search_keywords",
                                        "model",
                                        "brand",
                                        "price",
                                        "popularity",
                                        "category",
                                        "qnt",
                                        "status",
                                        "photo"
                                    ],
                                    properties: [
                                        new OA\Property(property: "id", type: "integer", example: 331),
                                        new OA\Property(property: "name", description: "Название товара", type: "string", example: "Массажная накидка Market", nullable: true),
                                        new OA\Property(property: "site_url", description: "Ссылка на товар на сайте", type: "string", nullable: true),
                                        new OA\Property(property: "search_keywords", description: "Также искать продукт по этим словам в поиске сайта", type: "string", example: "miami\r\nмиами\r\nмаями\r\nмиями", nullable: true),
                                        new OA\Property(property: "model", description: "Модель", type: "string", example: "Miami", nullable: true),
                                        new OA\Property(property: "brand", description: "Бренд", type: "string", example: "Market", nullable: true),
                                        new OA\Property(property: "price", description: "Цена", type: "integer", example: 1900, nullable: true),
                                        new OA\Property(property: "popularity", description: "Популярность", type: "integer", example: 11, nullable: true),
                                        new OA\Property(
                                            property: "category",
                                            description: "категории",
                                            properties: [
                                                new OA\Property(
                                                    property: "subcategories",
                                                    description: "Подкатегории",
                                                    type: "array",
                                                    items: new OA\Items(
                                                        type: "string"
                                                    ),
                                                    example: ['market', 'market', 'market2'],
                                                    nullable: true
                                                ),
                                                new OA\Property(property: "id", description: "ID категории", type: "integer", example: 1, nullable: true),
                                                new OA\Property(property: "title", description: "Название категории", type: "string", example: "Массажные накидки", nullable: true),
                                            ],
                                            type: "object",
                                            nullable: true
                                        ),
                                        new OA\Property(
                                            property: "qnt",
                                            description: "Количество",
                                            required: ["color", "text"],
                                            properties: [
                                                new OA\Property(property: "color", description: "Цвет плашки", type: "string", example: "purple", nullable: true),
                                                new OA\Property(property: "text", description: "Предзаказ или цифра количества", type: "string", example: 11, nullable: true),
                                            ],
                                            type: "object",
                                            nullable: true
                                        ),
                                        new OA\Property(property: "status", description: "Статус", type: "string", example: "Опубликован", nullable: true),
                                        new OA\Property(property: "photo", description: "Первое фото товара в самом маленьком размере", type: "string", nullable: true),
                                    ]
                                )
                            )
                        ]
                    )
                ]
            )
        ),
        new OA\Response(ref: "#/components/responses/401", response: 401)
    ]
)]

#[OA\Post(
    path: "/api/admin/products",
    summary: "Создание товара",
    security: [["bearerAuth" => []]],
    requestBody: new OA\RequestBody(
        content: new OA\JsonContent(
            allOf: [
                new OA\Schema(
                    required: [
                        "seo_url",
                        "status_id",
                        "system_name",
                        "model",
                        "name"
                    ],
                    properties: [
                        new OA\Property(
                            property: "additional_products_basket",
                            description: "С этим товаром покупают в корзине",
                            type: "array",
                            items: new OA\Items(
                                properties: [
                                    new OA\Property(
                                        property: "id",
                                        type: "integer",
                                        example: 138
                                    )
                                ]
                            )
                        ),
                        new OA\Property(property: "brand_id", description: "ID бренда", type: "integer", example: 3),
                        new OA\Property(
                            property: "categories",
                            description: "Категории товара",
                            type: "array",
                            items: new OA\Items(
                                properties: [
                                    new OA\Property(
                                        property: "id",
                                        type: "integer",
                                        example: 193
                                    )
                                ]
                            )
                        ),
                        new OA\Property(property: "category_breadcrumbs_id", description: "ID категории для хлебных крошек", type: "integer", example: 137, nullable: true),
                        new OA\Property(property: "category_compare_id", description: "ID категории для сравнения", type: "integer", example: 138, nullable: true),
                        new OA\Property(property: "land_video_file_id_desktop", description: "ID видео десктоп в лендинге", type: "integer", example: 333, nullable: true),
                        new OA\Property(property: "is_active_land_video_desktop", description: "Видео десктоп в лендинге активно", type: "integer", example: 1, nullable: true),
                        new OA\Property(property: "land_video_file_id_mobile", description: "ID видео мобайл в лендинге", type: "integer", example: 333, nullable: true),
                        new OA\Property(property: "is_active_land_video_mobile", description: "Видео мобайл в лендинге активно", type: "integer", example: 1, nullable: true),
                        new OA\Property(property: "model", description: "Модель", type: "string", example: "Aeroprene Elbow Support", nullable: true),
                        new OA\Property(property: "name", description: "Название товара", type: "string", nullable: true),
                        new OA\Property(property: "note", description: "Примечание", type: "string", nullable: true),
                        new OA\Property(property: "popularity", description: "Популярность", type: "integer", example: 12, nullable: true),
                        new OA\Property(property: "price", description: "Цена", type: "integer", example: 95, nullable: true),
                        new OA\Property(property: "price_promotion", description: "Цена по акции", type: "integer", example: 95, nullable: true),
                        new OA\Property(property: "price_preorder", description: "Цена предзаказа", type: "integer", example: 95, nullable: true),
                        new OA\Property(
                            property: "rent",
                            description: "Аренда",
                            type: "array",
                            items: new OA\Items(
                                properties: [
                                    new OA\Property(property: "id", type: "integer", example: null, nullable: true),
                                    new OA\Property(property: "rent_id", description: "", type: "integer", example: 1, nullable: true),
                                    new OA\Property(property: "price", description: "Цена", type: "integer", example: 5000, nullable: true),
                                    new OA\Property(property: "price_promotion", description: "Цена по акции", type: "integer", example: 0, nullable: true),
                                    new OA\Property(property: "price_preorder", description: "Цена предзаказа", type: "integer", example: 0, nullable: true)
                                ]
                            )
                        ),
                        new OA\Property(property: "search_keywords", description: "Так же искать продукт по этим словам в поиске сайта", type: "string", example: "axiom\r\n аксиом", nullable: true),
                        new OA\Property(property: "seo_url", description: "Адрес страницы", type: "string", example: "products/pilot"),
                        new OA\Property(property: "seo_title", description: "Заголовок страницы", type: "string", example: "Массажная накидка MARKET"),
                        new OA\Property(property: "seo_keywords", description: "Ключевые слова", type: "string", example: "Массажная накидка MARKET"),
                        new OA\Property(property: "seo_description", description: "Описание страницы", type: "string"),
                        new OA\Property(property: "short_name", description: "Короткое название", type: "string", example: "Бандаж на локтевой сустав", nullable: true),
                        new OA\Property(
                            property: "size",
                            description: "Размеры",
                            type: "array",
                            items: new OA\Items(
                                properties: [
                                    new OA\Property(property: "id", type: "integer", example: null, nullable: true),
                                    new OA\Property(property: "size_id", description: "", type: "integer", example: 1, nullable: true),
                                    new OA\Property(property: "price", description: "Цена", type: "integer", example: 5000, nullable: true),
                                    new OA\Property(property: "price_promotion", description: "Цена по акции", type: "integer", example: 0, nullable: true),
                                    new OA\Property(property: "price_preorder", description: "Цена предзаказа", type: "integer", example: 0, nullable: true)
                                ]
                            )
                        ),
                        new OA\Property(
                            property: "params",
                            description: "Тех.хар.",
                            type: "array",
                            items: new OA\Items(
                                required: ["colors", "techs"],
                                properties: [
                                    new OA\Property(
                                        property: "colors",
                                        description: "Цвета",
                                        type: "array",
                                        items: new OA\Items(
                                            required: ['id', 'name', 'code', 'isImg', 'imgUrl'],
                                            properties: [
                                                new OA\Property(property: "id", type: "integer", example: 18),
                                                new OA\Property(property: "name", description: "Цвет товара", type: "string", example: "Красный"),
                                                new OA\Property(property: "code", description: "Код цвета", type: "string", example: "#FF0000"),
                                                new OA\Property(property: "isImg", description: "Это картинка", type: "bool", example: false),
                                                new OA\Property(property: "imgUrl", description: "Url картинки", type: "string", example: "http..."),
                                            ]
                                        )
                                    ),
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
                                ]
                            )
                        ),
                        new OA\Property(property: "slogan_color", description: "Код цвета слогана", type: "string", example: "#000000", nullable: true),
                        new OA\Property(property: "slogan_font_size", description: "Размер шрифта слогана", type: "string", example: "30", nullable: true),
                        new OA\Property(property: "slogan_text", description: "Слоган", type: "string", example: "Надежная защита и поддержка", nullable: true),
                        new OA\Property(property: "status_id", description: "ID статуса", type: "integer", example: 1, nullable: true),
                        new OA\Property(property: "text_app", description: "Описание для приложения", type: "string", nullable: true),
                        new OA\Property(property: "text_benefit", description: "Фраза о выгоде в год", type: "string", nullable: true),
                        new OA\Property(property: "text_full", description: "Полное описание (если лендинга нет — выводится это описание)", type: "string", nullable: true),
                        new OA\Property(property: "text_short", description: "Короткое описание (фид для Яндекс)", type: "string", nullable: true),
                    ]
                )
            ]
        )
    ),
    tags: ["Admin / Product"],
    responses: [
        new OA\Response(
            response: 200,
            description: "Ok",
            content: new OA\JsonContent(
                allOf: [
                    new OA\Schema(ref: "#/components/schemas/ProductSchema")
                ]
            )
        ),
        new OA\Response(ref: "#/components/responses/401", response: 401)
    ]
)]

#[OA\Get(
    path: "/api/admin/products/{product}",
    summary: "Один товар",
    security: [["bearerAuth" => []]],
    tags: ["Admin / Product"],
    parameters: [
        new OA\Parameter(
            name: "product",
            description: "ID товара",
            in: "path",
            required: true,
            example: 331
        )
    ],
    responses: [
        new OA\Response(
            response: 200,
            description: "Ok",
            content: new OA\JsonContent(
                allOf: [
                    new OA\Schema(ref: "#/components/schemas/ProductSchema")
                ]
            )
        ),
        new OA\Response(ref: "#/components/responses/401", response: 401),
        new OA\Response(ref: "#/components/responses/404", response: 404)
    ]
)]

#[OA\Patch(
    path: "/api/admin/products/{product}",
    summary: "Обновление товара",
    security: [["bearerAuth" => []]],
    requestBody: new OA\RequestBody(
        content: new OA\JsonContent(
            allOf: [
                new OA\Schema(
                    required: [
                        "id",
                        "seo",
                        "seo_url",
                        "status_id",
                        "model",
                        "name"
                    ],
                    properties: [
                        new OA\Property(
                            property: "additional_products_basket",
                            description: "С этим товаром покупают в корзине",
                            type: "array",
                            items: new OA\Items(
                                properties: [
                                    new OA\Property(
                                        property: "id",
                                        type: "integer",
                                        example: 138
                                    )
                                ]
                            )
                        ),
                        new OA\Property(
                            property: "additional_products_landing",
                            description: "С этим товаром покупают на лендинге",
                            type: "array",
                            items: new OA\Items(
                                properties: [
                                    new OA\Property(
                                        property: "id",
                                        type: "integer",
                                        example: 138
                                    )
                                ]
                            )
                        ),
                        new OA\Property(property: "brand_id", description: "ID бренда", type: "integer", example: 3),
                        new OA\Property(
                            property: "categories",
                            description: "Категории товара",
                            type: "array",
                            items: new OA\Items(
                                properties: [
                                    new OA\Property(
                                        property: "id",
                                        type: "integer",
                                        example: 193
                                    )
                                ]
                            )
                        ),
                        new OA\Property(property: "category_breadcrumbs_id", description: "ID категории для хлебных крошек", type: "integer", example: 137, nullable: true),
                        new OA\Property(property: "category_compare_id", description: "ID категории для сравнения", type: "integer", example: 138, nullable: true),
                        new OA\Property(property: "id", description: "ID товара", type: "integer", example: 83),
                        new OA\Property(property: "is_active_land_video_mobile", description: "Видео мобайл в лендинге активно", type: "integer", example: 1, nullable: true),
                        new OA\Property(property: "model", description: "Модель", type: "string", example: "Aeroprene Elbow Support", nullable: true),
                        new OA\Property(property: "name", description: "Название товара", type: "string", example: "Бандаж на локтевой сустав", nullable: true),
                        new OA\Property(property: "note", description: "Примечание", type: "string", example: "благополучия", nullable: true),
                        new OA\Property(property: "popularity", description: "Популярность", type: "integer", example: 12, nullable: true),
                        new OA\Property(property: "price", description: "Цена", type: "integer", example: 95, nullable: true),
                        new OA\Property(property: "price_promotion", description: "Цена по акции", type: "integer", example: 95, nullable: true),
                        new OA\Property(property: "price_preorder", description: "Цена предзаказа", type: "integer", example: 95, nullable: true),
                        new OA\Property(
                            property: "rent",
                            description: "Аренда",
                            type: "array",
                            items: new OA\Items(
                                properties: [
                                    new OA\Property(property: "id", type: "integer", example: null, nullable: true),
                                    new OA\Property(property: "rent_id", description: "", type: "integer", example: 1, nullable: true),
                                    new OA\Property(property: "price", description: "Цена", type: "integer", example: 5000, nullable: true),
                                    new OA\Property(property: "price_promotion", description: "Цена по акции", type: "integer", example: 0, nullable: true),
                                    new OA\Property(property: "price_preorder", description: "Цена предзаказа", type: "integer", example: 0, nullable: true)
                                ]
                            )
                        ),
                        new OA\Property(property: "search_keywords", description: "Так же искать продукт по этим словам в поиске сайта", type: "string", example: "axiom\r\n аксиом\r\n  axiom кресло кресло ", nullable: true),
                        new OA\Property(
                            property: "seo",
                            type: "object",
                            allOf: [
                                new OA\Schema(ref: "#/components/schemas/SeoSchema")
                            ]
                        ),
                        new OA\Property(property: "seo_url", description: "Адрес страницы", type: "string", example: "products/pilot"),
                        new OA\Property(property: "seo_title", description: "Заголовок страницы", type: "string", example: "Market"),
                        new OA\Property(property: "seo_keywords", description: "Ключевые слова", type: "string", example: "Market"),
                        new OA\Property(property: "seo_description", description: "Описание страницы", type: "string", example: "Market"),
                        new OA\Property(property: "short_name", description: "Короткое название", type: "string", example: "Market", nullable: true),
                        new OA\Property(
                            property: "size",
                            description: "Размеры",
                            type: "array",
                            items: new OA\Items(
                                properties: [
                                    new OA\Property(property: "id", type: "integer", example: null, nullable: true),
                                    new OA\Property(property: "size_id", description: "", type: "integer", example: 1, nullable: true),
                                    new OA\Property(property: "price", description: "Цена", type: "integer", example: 5000, nullable: true),
                                    new OA\Property(property: "price_promotion", description: "Цена по акции", type: "integer", example: 0, nullable: true),
                                    new OA\Property(property: "price_preorder", description: "Цена предзаказа", type: "integer", example: 0, nullable: true)
                                ]
                            )
                        ),
                        new OA\Property(property: "slogan_color", description: "Код цвета слогана", type: "string", example: "#000000", nullable: true),
                        new OA\Property(property: "slogan_font_size", description: "Размер шрифта слогана", type: "string", example: "30", nullable: true),
                        new OA\Property(property: "slogan_text", description: "Слоган", type: "string", example: "Надежная защита и поддержка", nullable: true),
                        new OA\Property(property: "status_id", description: "ID статуса", type: "integer", example: 1, nullable: true),
                        new OA\Property(property: "system_name", description: "Системное название", type: "string", example: "aeroprene_elbow_support", nullable: true),
                        new OA\Property(property: "text_app", description: "Описание для приложения", type: "string", nullable: true),
                        new OA\Property(property: "text_benefit", description: "Фраза о выгоде в год", type: "string", nullable: true),
                        new OA\Property(property: "text_full", description: "Полное описание (если лендинга нет — выводится это описание)", type: "string", nullable: true),
                        new OA\Property(property: "text_short", description: "Короткое описание (фид для Яндекс)", type: "string", example: "<p>Бандаж на локтевой сустав ", nullable: true),
                        new OA\Property(
                            property: "cart_gallery",
                            description: "Карточка галереи",
                            type: "array",
                            items: new OA\Items(
                                properties: [
                                    new OA\Property(property: "id", description: "ID ", type: "integer", example: 2, nullable: true),
                                    new OA\Property(property: "type", description: "Тип: фото или видео", type: "string", enum: ["photo", "video"]),
                                    new OA\Property(property: "is_active", description: "Опубликован", type: "integer", example: 1, nullable: true),
                                    new OA\Property(property: "photo_title", description: "Название", type: "string", example: "Кресло", nullable: true),
                                    new OA\Property(property: "photo_alt", description: "Превью названия", type: "string", example: "Кресло", nullable: true),
                                    new OA\Property(property: "photo_is_feed", type: "integer", example: 1, nullable: true),
                                    new OA\Property(property: "photoNewFile", description: "Загруженный файл", type: "file"),
                                    new OA\Property(property: "video_youtube_link", description: "Ссылка на видео с ютуба", type: "string", example: "https://www.youtube.com/watch?v=515an742WVg&ab_channel=%D0%9F%D0%BE%D0%BB%gfbbhdfhbgcbfgcbhD1%83%D0%BE%D1%81%D1%82%D1%80%D0%BE%D0%B2%D0%A1%D0%BE%D0%BA%D1%80%D0%BE%D0%B2%D0%B8%D1%89", nullable: true),
                                    new OA\Property(property: "video_search_text", description: "Текст для поиска", type: "string", example: 1, nullable: true),
                                    new OA\Property(property: "video_description", description: "Описание видео", type: "string", example: "Кресло", nullable: true),
                                    new OA\Property(property: "video_instruction", description: "Инструкции", type: "integer", example: 0, nullable: true),
                                    new OA\Property(property: "video_stars", description: "Звезды", type: "integer", example: 1, nullable: true),
                                    new OA\Property(property: "video_beauty_slide", description: "Бьюти-академия", type: "integer", example: 1, nullable: true),
                                ]
                            )
                        ),
                    ]
                )
            ]
        )
    ),
    tags: ["Admin / Product"],
    parameters: [
        new OA\Parameter(name: "product", description: "ID товара", in: "path", required: true, example: 331)
    ],
    responses: [
        new OA\Response(
            response: 200,
            description: "Ok",
            content: new OA\JsonContent(
                required: ["data", "revalidatePath", "warnings"],
                properties: [
                    new OA\Property(
                        property: "data",
                        type: "object",
                        allOf: [
                            new OA\Schema(ref: "#/components/schemas/ProductSchema")
                        ]
                    ),
                    new OA\Property(
                        property: "revalidatePath",
                        ref: "#/components/schemas/RevalidatePath"
                    ),
                    new OA\Property(
                        property: "warnings",
                        description: "Предупреждения",
                        type: "array",
                        items: new OA\Items()
                    ),
                    new OA\Property(
                        property: "cart_gallery",
                        description: "Карточка галереи",
                        type: "array",
                        items: new OA\Items(
                            properties: [
                                new OA\Property(property: "id", description: "ID ", type: "integer", example: 2),
                                new OA\Property(property: "type", description: "Тип: фото или видео", type: "string", enum: ["photo", "video"]),
                                new OA\Property(property: "is_active", description: "Опубликован", type: "integer", example: 1, nullable: true),
                                new OA\Property(property: "photo_title", description: "Название", type: "string", example: "Кресло", nullable: true),
                                new OA\Property(property: "photo_alt", description: "Превью названия", type: "string", example: "Кресло market", nullable: true),
                                new OA\Property(property: "photo_is_feed", type: "integer", example: 1, nullable: true),
                                new OA\Property(property: "photoNewFile", description: "Загруженный файл", type: "file"),
                                new OA\Property(property: "video_youtube_link", description: "Ссылка на видео с ютуба", type: "string", example: "https://www.youtube.com/watch?v=515an74dgffdrfde2WVg&ab_channel=%Ddsdstgde0%9F%D0%BE%D0%BB%D1%83%D0%BE%D1%81%D1%82%D1%80%D0%BE%D0%B2%D0%A1%D0%BE%D0%BA%D1%80%D0%BE%D0%B2%D0%B8%D1%89", nullable: true),
                                new OA\Property(property: "video_search_text", description: "Текст для поиска", type: "string", example: 1, nullable: true),
                                new OA\Property(property: "video_description", description: "Описание видео", type: "string", example: "Кресло", nullable: true),
                                new OA\Property(property: "video_instruction", description: "Инструкции", type: "integer", example: 0, nullable: true),
                                new OA\Property(property: "video_stars", description: "Звезды", type: "integer", example: 1, nullable: true),
                                new OA\Property(property: "video_beauty_slide", description: "Бьюти-академия", type: "integer", example: 1, nullable: true),
                            ]
                        )
                    ),
                ]
            )
        ),
        new OA\Response(ref: "#/components/responses/401", response: 401),
        new OA\Response(ref: "#/components/responses/404", response: 404)
    ]
)]

#[OA\Delete(
    path: "/api/admin/products/{product}",
    summary: "Удаление товара",
    security: [["bearerAuth" => []]],
    tags: ["Admin / Product"],
    parameters: [
        new OA\Parameter(
            name: "product",
            description: "ID товара",
            in: "path",
            required: true,
            example: 26
        )
    ],
    responses: [
        new OA\Response(
            response: 200,
            description: "Ok",
            content: new OA\JsonContent(
                required: ["data", "revalidatePath"],
                properties: [
                    new OA\Property(
                        property: "data",
                        type: "object",
                        allOf: [
                            new OA\Schema(ref: "#/components/schemas/ProductSchema")
                        ]
                    ),
                    new OA\Property(
                        property: "revalidatePath",
                        description: "Где используется",
                        type: "array",
                        items: new OA\Items(type:"string", example:"market.ru")
                    )
                ]
            )
        ),
        new OA\Response(ref: "#/components/responses/401", response: 401),
        new OA\Response(ref: "#/components/responses/404", response: 404)
    ]
)]

class ProductController extends Controller
{

}

