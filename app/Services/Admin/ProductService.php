<?php

namespace App\Services\Admin;

use App\Models\Color;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\ProductRent;
use App\Models\ProductSize;
use App\Services\File\ProductGalleryService;
use App\Services\File\Upload\UploadFileService;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use SimpleXMLElement;

class ProductService
{
    /**
     * Сохраняет поля "с этим товаром покупают"
     * используется при сохранении карточки товара
     * @param array $data Данные, полученные из формы карточки товара
     */
    public static function syncAdditionalProducts(Product $product, array &$data): void
    {
        $relation = [];
        if (!empty($data['additional_products_basket']) && count($data['additional_products_basket'])) {
            foreach ($data['additional_products_basket'] as $sort => $arProduct) {
                $relation[$arProduct['id']] = [
                    'sort' => $sort,
                    'type' => 'basket',
                ];
            }
        }
        unset($data['additional_products_basket']);
        $product->additionalProductsBasket()->sync($relation);

        $relation = [];
        if (!empty($data['additional_products_landing']) && count($data['additional_products_landing'])) {
            foreach ($data['additional_products_landing'] as $sort => $arProduct) {
                $relation[$arProduct['id']] = [
                    'sort' => $sort,
                    'type' => 'landing',
                ];
            }
        }
        unset($data['additional_products_landing']);
        $product->additionalProductsLanding()->sync($relation);
    }

    /**
     * Сохраняет поля "Аренда"
     * используется при сохранении карточки товара
     * @param array $data Данные, полученные из формы карточки товара
     */
    public static function syncRent(Product $product, array &$data): void
    {
        $arIDs = [];
        if (!empty($data['rent']) && count($data['rent'])) {
            // Создаём новые пункты или обновляем существующие
            foreach ($data['rent'] as $item) {
                $item['product_id'] = $product->id;
                if ($item['id'] === null) {
                    $updated = ProductRent::create($item);
                } else {
                    $updated = ProductRent::updateOrCreate(
                        ['id' => $item['id']],
                        $item
                    );
                }
                $arIDs[] = $updated->id;
            }
        }
        // Удаляем несуществующие
        ProductRent::where('product_id', $product->id)->whereNotIn('id', $arIDs)->delete();
        unset($data['rent']);
    }

    /**
     * Сохраняет поля "Размеры"
     * используется при сохранении карточки товара
     * @param array $data Данные, полученные из формы карточки товара
     */
    public static function syncSize(Product $product, array &$data): void
    {
        $arIDs = [];
        if (!empty($data['size']) && count($data['size'])) {
            // Создаём новые пункты или обновляем существующие
            foreach ($data['size'] as $item) {
                $item['product_id'] = $product->id;
                if ($item['id'] === null) {
                    $updated = ProductSize::create($item);
                } else {
                    $updated = ProductSize::updateOrCreate(
                        ['id' => $item['id']],
                        $item
                    );
                }
                $arIDs[] = $updated->id;
            }
        }
        // Удаляем несуществующие
        ProductSize::where('product_id', $product->id)->whereNotIn('id', $arIDs)->delete();
        unset($data['size']);

    }

    /**
     * Сохраняет поля "Параметры и Фильтры"
     * @param Product $product
     * @param array $data
     * @return void
     */
    public static function syncParam(Product $product, array &$data): void
    {
        if (isset($data['params']['techs'])) {
            // Проходим по параметрам из данных
            foreach ($data['params']['techs'] as $index => $tech) {
                // Находим или создаем параметр продукта
                $productParam = $product->params()->updateOrCreate(
                    [
                        'product_id' => $product->id,
                        'param_id' => $tech['id'],
                    ],
                    [
                        'value' => $tech['value'],
                        'sort' => $index + 1,
                    ]
                );

                // Синхронизируем фильтры параметра
                $filterIds = array_map(fn($filter) => $filter['id'], $tech['filters']);
                $productParam->filters()->sync($filterIds);
            }

            // Удаляем параметры, которые не были переданы в данных
            $paramIds = array_column($data['params']['techs'], 'id');
            $product->params()->whereNotIn('param_id', $paramIds)->delete();
        }
    }

    /**
     * Сохраняет поля "Цвет"
     * @param Product $product
     * @param array $data
     * @return void
     */
    public static function syncColor(Product $product, array $data): void
    {
        if (isset($data['params']['colors'])) {
            $colors = $data['params']['colors'];
            $colorIds = [];

            foreach ($colors as $colorData) {
                if (isset($colorData['id'])) {
                    $color = Color::find($colorData['id']);
                    if ($color) {
                        ColorService::update($color, $colorData);
                        $colorIds[] = $color->id;
                    }
                } else {
                    $newColor = ColorService::store();
                    ColorService::update($newColor, $colorData);
                    $colorIds[] = $newColor->id;
                }
            }

            // Синхронизируем цвета продукта
            $product->colors()->sync($colorIds);
        } else {
            // Если цвета не переданы, удаляем все связанные цвета
            $product->colors()->detach();
        }
    }

    /**
     * Подготавливает для сохранения связь по id
     * используется при сохранении карточки товара
     * @param array $data Данные, полученные из формы карточки товара
     * @param string $key Ключ массива $data
     * @return array
     */
    public static function processRelationInput(array &$data, string $key): array
    {
        $relation = [];
        if (!empty($data[$key]) && count($data[$key])) $relation = array_column($data[$key], 'id');
        unset($data[$key]);
        return $relation;
    }

    /**
     * Обновляет товар
     * @param Product $product
     * @param array $data данные из формы карточки товара
     * @return Product
     */
    public static function update(Product $product, array $data): Product
    {
        DB::transaction(function () use ($product, $data) {
            self::syncAdditionalProducts($product, $data);
            self::syncRent($product, $data);
            self::syncSize($product, $data);
            self::syncParam($product, $data);
            self::syncColor($product, $data);
            if (isset($data['params'])) unset($data['params']);

            $product->categories()->sync(self::processRelationInput($data, 'categories'));

            $product->seo->updateOrCreate(
                ['id' => $data['seo']['id'] ?? null],
                $data['seo']
            );
            unset($data['seo']);

            if (
                $product->land_video_file_id_desktop !== null &&
                $product->land_video_file_id_desktop !== $data['land_video_file_id_desktop']
            ) {
                $product->landVideoDesktop()->delete();
            }
            if (
                $product->land_video_file_id_mobile !== null &&
                $product->land_video_file_id_mobile !== $data['land_video_file_id_mobile']
            ) {
                $product->landVideoMobile()->delete();
            }

            $product->update($data);
        });
        return self::getProductFullData($product);
    }

    /**
     * Возвращает все данные о товаре
     * @param Product $product
     * @return Product
     */
    public static function getProductFullData(Product $product): Product
    {

        $product = $product->loadMissing([
            'brand',
            'landVideoDesktop',
            'landVideoMobile',
            'status',
            'categoryCompare',
            'badges',
            'categories',
            'params.filters',
            'params.param',
            'QRCodes',
            'rent',
            'size',
            'additionalProductsLanding',
            'additionalProductsBasket',
            'gallery',
            'size',
            'storageMoscow'

        ]);
        $product->qnt = $product->status_id === 5 ? ['color' => 'purple', 'text' => 'Предзаказ'] : ['color' => null];
        return $product;
    }

    /**
     * Создание пустого товара
     * @param array $data массив данных из формы
     * @return Product
     */
    public static function store(array $data): Product
    {
        $product = Product::create();
        $product->seo()->create();
        $data['seo']['id'] = $product->seo->id;
        return self::update($product, $data);
    }
}

