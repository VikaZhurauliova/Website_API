<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\News\NewsRequest;
use App\Http\Resources\Admin\News\NewsListResource;
use App\Http\Resources\Admin\News\NewsResource;
use App\Models\News;
use App\Services\Admin\NewsService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class NewsController extends Controller
{
    /**
     * Список новостей
     *
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        return NewsListResource::collection(News::all());
    }

    /**
     * Создание новости
     *
     * @param NewsRequest $request
     * @return NewsResource
     */
    public function store(NewsRequest $request)
    {
        $data = $request->validated();
        return NewsResource::make(NewsService::store($data));
    }
    /**
     * Одна новость
     *
     * Display the specified resource.
     */
    public function show(News $news): NewsResource
    {
        return NewsResource::make($news);
    }

    /**
     * Обновление новости
     *
     * Update the specified resource in storage.
     */
    public function update(NewsRequest $request, News $news)
    {
        $data = $request->validated();

        return NewsResource::make(NewsService::update($news, $data));
    }

    /**
     * Удаление новости
     *
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        $this->deleteImage($news);
        $news->categories()->detach();
        $news->seo()->delete();
        $news->delete();

        return response()->noContent();
    }

    /**
     * Удаление изображения из новости
     *
     * @param News $news
     * @return Response
     */
    public function deleteImage(News $news)
    {
        NewsService::deleteImage($news);

        return response()->noContent();
    }
}
