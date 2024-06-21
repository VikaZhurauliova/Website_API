<?php

namespace App\Console\Commands\import\Market;

use App\Models\Product;
use App\Models\ProductGallery;
use App\Services\File\ProductGalleryService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MakeVideoLinksForGalleryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:make_video_links_for_gallery_market';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Создаёт ссылки на видео на youtube для товаров в галерее';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $videos = [
            122 => 'https://www.youtube.com/watch?v=rTLynn2_DhU'
        ];
        foreach ($videos as $product_id => $link) {
            $sort = ProductGallery::select('sort')
                ->where('product_id', $product_id)
                ->orderByDesc('sort')
                ->first()
                ->sort;
            $sort++;
            ProductGallery::create([
                'product_id' => $product_id,
                'type' => 'video',
                'is_active' => 1,
                'sort' => $sort,
                'video_youtube_link' => $link
            ]);
        }


    }
}
