<?php

namespace App\Console\Commands\import\Market;

use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UpdateProductsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:market_update_products_table';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Заполняет недостающие поля в таблице товаров для сайта market';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        DB::connection('market_old')->table('s_products')->get()->each(function ($product) {
            $search_keywords = explode(', ', $product->meta_keywords);
            foreach ($search_keywords as &$search_keyword) {
                $search_keyword = trim($search_keyword);
            }
            $search_keywords = implode('
', $search_keywords);
            $short_name = $product->alter_category_name;
            if (empty($short_name)) {
                $category_id = DB::connection('market_old')->table('s_products_categories')
                    ->where('product_id', $product->id)->first()->category_id;
                $short_name = DB::connection('market_old')->table('s_categories')
                    ->where('id', $category_id)->first()->name_singular;
            }

            $priceData = $this->getPriceData($product->id);
            $pricePromotion = $priceData->compare_price === 0.0 ? 0 : $priceData->price;

            DB::table('products')->where('id', $product->id)
                ->update([
                    'search_keywords' => $search_keywords,
                    'short_name' => $short_name,
                    'status_id' => $product->discontinued ? 7 : ($product->visible ? 1 : 2),
                    'badge_promo' => !empty($pricePromotion) ? 1 : null,
                ]);
        });

        $host = 'https://' . request()->getHttpHost();
        Product::where('text_full', 'like', '%src="/files/%')->get()
            ->each(function($product) use($host) {
                $product->text_full = Str::replace('src="/files/', 'src="' . $host . '/storage/files/', $product->text_full);
                $product->save();
            });
        DB::table('products')->where('id', 88)
            ->update([
                'id' => 188,
            ]);
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
