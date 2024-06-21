<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Http\Requests\Common\DomainRequest;
use App\Http\Requests\Shop\CartRequest;
use App\Models\Cart;
use App\Services\Shop\CartService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class CartController extends Controller
{
    /**
     * Получение корзины пользователя
     * @param DomainRequest $request
     * @return array
     */
    public function index(DomainRequest $request): array
    {
        $domainId = $request->validated()['domain_id'];
        return ['data' => CartService::cartContent($domainId)];
    }


    /**
     * Добавление товара в корзину
     *
     * @param CartRequest $request
     * @return Response
     */
    public function store(CartRequest $request): Response
    {
        $data = $request->validated();
        $result = CartService::store($data);
        if (isset($result['message'])) {
            return response(['message' => $result['message']], 400);
        }
        return response($result, 200);
    }

    /**
     * Удаление товара из корзины
     *
     * @param Cart $cart
     * @return Response
     */
    public function destroy(Cart $cart): Response
    {
        return CartService::destroy($cart) ? response()->noContent() : response(
        [
            'error' => 'Не удалось удалить товар из корзины'
        ],
        500);
    }

}
