<?php

namespace App\Services\Shop;

use App\Http\Resources\Shop\CartResource;
use App\Http\Resources\Shop\CompareResource;
use App\Models\Cart;
use App\Models\Domain;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class CartService
{
    /**
     * Добавление товара в Корзину
     * @param array $data
     * @return array
     */
    public static function store(array $data): array
    {
        $product = Product::find($data['product_id']);
        if ($product?->storage_status['code'] !== 'avail') {
            return ['message' => 'Данный товар недоступен для заказа'];
        }

        $cartItem = Cart::addMy($data);
        if ($cartItem->quantity !== $data['quantity']) {
            $cartItem->quantity = $data['quantity'];
            $cartItem->save();
        }
        return ['data' => ['id' => $cartItem->id]];
    }

    /**
     * Список товаров в корзине
     * @param int $domainId ID домена в таблице domains
     * @return Collection
     */
    public static function items(int $domainId): Collection
    {
        return Cart::with('product.status')->my($domainId)->get();
    }

    /**
     * Считает сумму товаров в корзине
     * @param Collection $items
     * @return int
     */
    public static function itemsSum(Collection $items): int
    {
        $sum = 0;
        $items->each(function ($item) use (&$sum) {
            $price = !empty($item->product?->price_promotion) ? $item->product->price_promotion : $item->product?->price;
            $sum += $price * $item->quantity;
        });
        return $sum;
    }

    /**
     * Считает стоимость доставки
     * @param int $itemsSum сумма товаров
     * @return int
     */
    public static function deliverySum(int $itemsSum): int
    {
        return $itemsSum < config('params.delivery.freeFrom') ? ($itemsSum > 0 ? config('params.delivery.price') : 0) : 0;
    }

    /**
     * Считает итоговую сумму корзины
     * @param int $itemsSum сумма товаров
     * @param int $deliverySum стоимость доставки
     * @return int
     */
    public static function totalSum(int $itemsSum, int $deliverySum): int
    {
        return $itemsSum + $deliverySum;
    }

    /**
     * Все данные в корзине
     * @param int $domainId ID домена в таблице domains
     * @return array
     */
    public static function cartContent(int $domainId): array
    {
        $domain = Domain::findOrFail($domainId);
        $items = self::items($domainId);
        $itemsSum = self::itemsSum($items);
        $deliverySum = self::deliverySum($itemsSum);
        $totalSum = self::totalSum($itemsSum, $deliverySum);
        return [
            'items' => $items->map(function ($item) use ($domain) {
                    return new CartResource($item, $domain);
                })->toArray(),
            'itemsSum' => $itemsSum,
            'deliverySum' => $deliverySum,
            'totalSum' => $totalSum,
        ];
    }

    /**
     * Удаление из корзины
     * @param Cart $cart
     * @return bool
     */
    public static function destroy(Cart $cart): bool
    {
        return $cart->deleteMy();
    }
}
