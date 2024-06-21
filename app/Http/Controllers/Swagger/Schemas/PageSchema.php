<?php

namespace App\Http\Controllers\Swagger\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "PageSchema",
    title: "Страница",
    required: [
        "id",
        "name",
        "isPublished",
        "template_id",
        "template_types",
        "teaser",
        "body",
        "seo",
        "seo_url",
        "seo_title",
        "seo_keywords",
        "seo_description",
        "isWithForm",
        "isWithLanding",
        "landing_url",
    ],
    properties: [
        new OA\Property(property: "id", description: "ID страницы", type: "integer", example: 189),
        new OA\Property(property: "name", description: "Название", type: "string", example: "Беспроцентный кредит: 0-0-12!", nullable: true),
        new OA\Property(property: "isPublished", description: "Статус: опубликован или не опубликован", type: "bool", example: true),
        new OA\Property(property: "template_id", description: "Шаблон страницы", type: "integer", example: 1, nullable: true),
        new OA\Property(property: "template_types", description: "Возможные типы шаблонов страниц", type: "array", items: new OA\Items(
            properties: [
                new OA\Property(property: "id", type: "integer", example: 1),
                new OA\Property(property: "name", description: "Код шаблона", type: "string", example: "ckeditor"),
            ],
            type: "object"
        )),
        new OA\Property(property: "teaser", type: "string", example: "dscds", nullable: true),
        new OA\Property(property: "body", type: "string", example: "<p>В клинике кинезиотера", nullable: true),
        new OA\Property(property: "seo_url", description: "Адрес страницы", type: "string", example: "catalog/market-cape", nullable: true),
        new OA\Property(property: "seo_title", description: "Заголовок страницы", type: "string", example: "catalog/market-cape", nullable: true),
        new OA\Property(property: "seo_keywords", description: "Ключевые слова", type: "string", example: "накидки", nullable: true),
        new OA\Property(property: "seo_description", description: "Описание страницы", type: "string", example: "Кресла, на которых мы сидим, зачастую дарят нам не только удобство, но и целый букет проблем", nullable: true),
        new OA\Property(property: "seo", description: "SEO страницы", type: "object", allOf: [new OA\Schema(ref: "#/components/schemas/SeoSchema")]),
        new OA\Property(property: "isWithForm", description: "Есть форма обратной связи", type: "bool", example: true),
        new OA\Property(property: "isWithLanding", description: "Использовать лендинг", type: "bool", example: true),
        new OA\Property(property: "landing_url", description: "URL лендинга", type: "string", example: "https://market.ru/laddndings/ab-rollsderывы-new", nullable: true),
    ]
)]

class PageSchema
{

}
