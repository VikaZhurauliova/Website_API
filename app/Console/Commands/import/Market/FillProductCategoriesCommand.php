<?php

namespace App\Console\Commands\import\Market;

use App\Models\Product;
use Illuminate\Console\Command;

class FillProductCategoriesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:market_fill_product_categories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Заполняет категории у товаров';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        Product::with('categories')->get()->each(function($product) {
            $product->category_breadcrumbs_id = $product->categories?->sortByDesc('parent_id')->first()?->id;
            $product->category_feed_id = $product->categories?->sortByDesc('parent_id')->first()?->id;
            $product->category_compare_id = $product->categories?->sortBy('parent_id')->first()?->id;
            $product->save();
        });
    }
}
