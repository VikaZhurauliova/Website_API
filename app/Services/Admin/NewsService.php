<?php

namespace App\Services\Admin;

use App\Models\News;
use App\Services\File\Upload\UploadFileService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class NewsService
{
    /**
     * Обновление новости
     *
     * @param News $news
     * @param array $data
     * @return News
     */
    public static function update(News $news, array $data): News
    {
        DB::transaction(function () use ($news, $data) {
            if (isset($data['image_src'])) {
                self::processImage($data, $news);
            }

            $news->seo->update(
                ['id' => $data['seo']['id'] ?? null],
                $data['seo']
            );
            $news->categories()->sync($data['categories']);
            unset($data['seo'], $data['categories']);

            $news->update($data);

        });
        return $news->fresh();
    }

    /**
     * Создание новости
     *
     * @param array $data
     * @return News
     */
    public static function store(array $data): News
    {
        $news = News::create();
        $news->seo()->create();
        $data['seo']['id'] = $news->seo->id;

        return self::update($news, $data);
    }

    /**
     * Загрузка изображения
     *
     * @param array $data
     * @param News $news
     * @return void
     */
    public static function processImage(array &$data, News $news): void
    {
        $imageParts = explode(";base64,", $data['image_src']);
        if (isset($imageParts[1])) {
            $data['image_src'] = UploadFileService::uploadFile($data['image_src'], config('files.newsFolder'), 300);
            if ($news->image_src !== null) {
                Storage::delete($news->image_src);
            }
        } else {
            unset($data['image_src']);
        }
    }

    /**
     * Удаление изображения из новости
     *
     * @param News $news
     * @return void
     */
    public static function deleteImage(News $news): void
    {
        if ($news->image_src !== null) {
            Storage::delete($news->image_src);
            $news->update(['image_src' => null, 'image_title' => null, 'image_alt' => null]);
        }
    }
}
