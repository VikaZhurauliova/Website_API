<?php

namespace App\Console\Commands\import\Market;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FillProductsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:market_fill_products_table';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Заполняет таблицу  товаров для сайта market.ru';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        DB::connection('market_old')->table('s_products')->orderBy('id')->chunk(100, function (Collection $products) {
            foreach ($products as $product) {
                //ID борбозы для товара
                $productId = $product->id;
                $Id = $this->getId($productId);

                // Цена, Цена со скидкой для товара
                $priceData = $this->getPriceData($productId);
                $price = $priceData->compare_price === 0.0 ? $priceData->price : $priceData->compare_price;
                $pricePromotion = $priceData->compare_price === 0.0 ? 0 : $priceData->price;

                if ($product->id === 202) $product->brand_id = 16;

                DB::table('products')->insert([
                    'id' => $Id,
                    'price' => $price,
                    'price_promotion' => $pricePromotion,
                    'price_preorder' => 0,
                    'name' => $product->name,
                    'brand_id' => $product->brand_id,
                    'model' => $product->name,
                    'short_name' => $product->name,
                    'system_name' => $product->url,
                    'badge_promo' => $product->sale,
                    'badge_bestseller' => $product->hit,
                    'status_id' => $product->visible ?: null,
                    'text_short' => $product->annotation,
                    'text_full' => str_replace('http://', 'https://', $product->body),
                    'created_at' => now()
                ]);
            }
        });

    }

    /**
     * Получение ID.
     *
     * @param int $productId
     * @return int
     */
    private function getId(int $productId): int
    {
        $itemIds = DB::connection('market_old')
            ->table('s_products')
            ->join('s_variants', 's_products.id', '=', 's_variants.product_id')
            ->join('s_ya_orders_variant', 's_variants.id', '=', 's_ya_orders_variant.variant_id')
            ->where('s_products.id', $productId)
            ->pluck('s_ya_orders_variant.item_id')
            ->toArray();
        return reset($itemIds);
    }

    /**
     * Получение цены товара
     *
     * @param int $productId
     * @return mixed
     */
    private function getPriceData(int $productId): mixed
    {
        return DB::connection('market_old')
            ->table('s_products')
            ->join('s_variants', 's_products.id', '=', 's_variants.product_id')
            ->where('s_products.id', $productId)
            ->select('s_variants.price', 's_variants.compare_price')
            ->first();
    }
}
