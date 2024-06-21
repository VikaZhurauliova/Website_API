<?php

namespace App\Console\Commands\import\Market;

use App\Models\Product;
use App\Models\ProductGallery;
use App\Services\File\ProductGalleryService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MakeAllPhotosForGalleryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:make_all_photos_for_gallery_market';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Создаёт фото всех размеров из исходных фото товаров со старого сайта';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        Product::whereNotNull('system_name')->get()->each(function ($product) {
            $sort = 0;
            DB::connection('market_old')->table('s_images')
                ->where('product_id', $product->id)
                ->orderBy('position')
                ->get()
                ->each(function ($image) use ($product, &$sort) {
                    // Формируем путь к исходному файлу изображения
                    $file = 'import' . DIRECTORY_SEPARATOR . 'product' . DIRECTORY_SEPARATOR . $image->filename;
                    if (Storage::exists($file)) {
                        $photoOriginalName = str_replace(' ', '_', $product->system_name) .
                            '.' . pathinfo($file)['extension'];
                        $productName = DB::connection('market_old')->table('s_products')
                            ->where('id', $image->product_id)
                            ->value('name');
                        $galleryItem = ProductGallery::create([
                            'product_id' => $product->id,
                            'type' => 'photo',
                            'is_active' => 1,
                            'sort' => $sort,
                            'photo_file_name_orig' => $photoOriginalName,
                            'photo_title' => $productName,
                            'photo_alt' => $productName,
                        ]);
                        $sort++;

                        $directory = config('files.productGalleryFolder') . DIRECTORY_SEPARATOR .
                            $galleryItem->id . DIRECTORY_SEPARATOR . 'original';

                        $productPhotoOriginal = $directory . DIRECTORY_SEPARATOR . $photoOriginalName;
                        Storage::makeDirectory($directory);
                        Storage::copy(
                            $file,
                            $productPhotoOriginal
                        );

                        ProductGalleryService::makeWebPImagesFromOriginal($productPhotoOriginal);
                    }
                });
        });
    }
}
