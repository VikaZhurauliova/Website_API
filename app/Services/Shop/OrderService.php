<?php

namespace App\Services\Shop;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderedItem;
use App\Models\Product;
use App\Services\AuthService;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;

class OrderService
{
    /**
     * Отправка заказа из корзины
     * @param array $data массив данных из формы корзины
     * @return Order
     */
    public static function storeCartOrder(array $data): Order
    {
        unset($data['guest_id']);
        $cart = CartService::cartContent($data['domain_id']);
        unset($data['domain_id']);
        if (empty($cart['items']) || !count($cart['items'])) {
            abort(500, 'Корзина пуста', ['message' => 'Корзина пуста']);
        }
        foreach ($cart['items'] as $item) {
            if ($item['product']['status_id'] === 6) {
                abort(400, 'Пожалуйста, сначала удалите из корзины товары, которые не доступны к заказу', ['message' => 'Пожалуйста, сначала удалите из корзины товары, которые не доступны к заказу']);
            }
        }

        // Создаём заказ и удаляем товары из корзины
        $data['items_sum'] = $cart['itemsSum'];
        $data['delivery_sum'] = $cart['deliverySum'];
        $data['total_sum'] = $cart['totalSum'];
        $order = DB::transaction(function () use ($data, $cart) {
            $order = Order::create($data);
            foreach ($cart['items'] as $item) {
                OrderedItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product']['id'],
                    'quantity' => $item['quantity'],
                    'price' => !empty($item['product']['pricePromotion']) ? $item['product']['pricePromotion'] : $item['product']['price'],
                ]);
                Cart::where('id', $item['id'])->delete();
            }
            return $order;
        });

        return $order->loadMissing('items.product.gallery');
    }

    /**
     * Быстрая покупка или Обратный звонок
     * @param array $data массив данных из формы быстрой покупки или обратного звонки
     * @return Order
     * @throws Exception
     */
    public static function storeFastOrder(array $data): Order
    {
        unset($data['guest_id']);
        if (isset($data['product_id'])) {
            $product = Product::find($data['product_id']);
            if ($product && $product->status_id === 6) {
                throw new Exception('Данный товар не доступен для заказа',400);
            }
        }
        // Информация о товаре, если это Быстрая покупка
        $product = null;
        $data['items_sum'] = 0;
        $data['delivery_sum'] = 0;
        $data['total_sum'] = 0;
        if (isset($data['product_id'])) {
            if (isset($data['type']) && $data['type'] === 'Форма быстрого заказа') $product = Product::find($data['product_id']);
            unset($data['product_id']);
        }
        if ($product !== null) {
            $data['items_sum'] = !empty($product->price_promotion) ? $product->price_promotion : $product->price;
            $data['total_sum'] = $data['items_sum'];
        }

        // Комментарий к заказу
        $comment = [];
        if (isset($data['type'])) {
            $comment[] = 'Тип заказа: ' . $data['type'];
            unset($data['type']);
        }
        if (isset($data['url'])) {
            $comment[] = 'Пришли со страницы: ' . $data['url'];
            unset($data['url']);
        }
        $data['comment'] = implode("\r\n", $comment);

        // Создаём заказ
        $order = DB::transaction(function () use ($data, $product) {
            $order = Order::create($data);
            if ($product !== null) {
                OrderedItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => 1,
                    'price' => $data['items_sum'],
                ]);
            }
            return $order;
        });

        return $order->loadMissing(['items.product.gallery', 'items.product.status']);
    }

    /**
     * Список всех заказов текущего пользователя
     * @return Collection
     */
    public static function myOrders(): Collection
    {
        return Order::my()->get();
    }
}
