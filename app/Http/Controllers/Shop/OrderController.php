<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shop\Order\CartOrderRequest;
use App\Http\Requests\Shop\Order\FastOrderRequest;
use App\Http\Resources\OrderResource;
use App\Jobs\BorbozaSendOrderJob;
use App\Services\Shop\OrderService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class OrderController extends Controller
{
    /**
     * Отправка заказа из корзины
     * @param CartOrderRequest $request
     * @return OrderResource
     */
    public function cartOrder(CartOrderRequest $request): OrderResource
    {
        $data = $request->validated();
        // Сохраняем заказ
        $order = OrderService::storeCartOrder($data);
        // Отправляем заказ в Борбозу
        BorbozaSendOrderJob::dispatch($order);
        return OrderResource::make($order);
    }

    /**
     * Быстрая покупка или Обратный звонок
     * @param FastOrderRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function fastOrder(FastOrderRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            $data = $request->validated();
            // Сохраняем заказ
            $order = OrderService::storeFastOrder($data);
            // Отправляем заказ в Борбозу
            BorbozaSendOrderJob::dispatch($order);
            return response()->json(['data' => new OrderResource($order)], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }

    /**
     * Список всех заказов текущего пользователя
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return OrderResource::collection(OrderService::myOrders());
    }

}
