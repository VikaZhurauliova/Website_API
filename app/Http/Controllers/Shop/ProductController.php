<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    /**
     * Возвращает актуальные данные (цену) одного или нескольких товаров
     */
    public function actual(int|array $products): JsonResponse
    {
        if (is_int($products)) {
            $product = Product::with('storageMoscow')->where('id', $products)->first();
            return response()->json([
                'data' =>  [
                    'id' => $product->id,
                    'price' => $product->price,
                    'pricePromotion' => $product->price_promotion,
                    'pricePreorder' => $product->price_preorder,
                    'storageStatus' => $product->storageStatus,
                ]
            ]);
        }
        return response()->json([
            'data' => Product::with('storageMoscow')->whereIn('id', $products)->get()
                ->map(function ($product) {
                    return [
                        'id' => $product->id,
                        'price' => $product->price,
                        'pricePromotion' => $product->price_promotion,
                        'pricePreorder' => $product->price_preorder,
                        'storageStatus' => $product->storageStatus,
                    ];
                })
        ]);
    }


}
