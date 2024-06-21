<?php

namespace App\Console\Commands\import;

use App\Models\Product;
use App\Models\ProductGallery;
use App\Services\File\ProductGalleryService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class MakeMissingPhotosForGalleryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:make_missing_photos_for_gallery';

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
        foreach (Storage::allDirectories('import') as $dir) {
            $systemName = str_replace('import/', '', $dir);
            $product = Product::where('system_name', $systemName)->with('gallery')->first();
            $product->gallery->each(function($gallery){
                $gallery->delete();
            });
            $sort = 0;
            foreach (Storage::files($dir) as $file) {
                $photoOriginalName = str_replace(' ', '_', $product->system_name) .
                    '.' . pathinfo($file)['extension'];
                $galleryItem = ProductGallery::create([
                    'product_id' => $product->id,
                    'type' => 'photo',
                    'is_active' => 1,
                    'sort' => $sort,
                    'photo_file_name_orig' => $photoOriginalName,
                    'photo_title' => $product->name,
                    'photo_alt' => $product->name,
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
        }
    }
}
