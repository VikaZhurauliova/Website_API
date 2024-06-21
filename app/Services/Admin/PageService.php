<?php

namespace App\Services\Admin;

use App\Models\News;
use App\Models\Page;
use App\Services\File\Upload\UploadFileService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PageService
{
    /**
     * Обновление страницы
     *
     * @param Page $page
     * @param array $data
     * @return Page
     */
    public static function update(Page $page, array $data): Page
    {
        DB::transaction(function () use ($page, $data) {
            $page->seo->updateOrCreate(
                ['id' => $data['seo']['id'] ?? null],
                $data['seo']
            );
            unset($data['seo']);

            $page->update($data);
        });
        return $page->fresh();
    }
}
