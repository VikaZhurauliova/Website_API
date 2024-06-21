<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryForNews\CategoryForNewsRequest;
use App\Http\Resources\Admin\CategoryForNews\CategoryForNewsResource;
use App\Models\CategoryForNews;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryForNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        return JsonResource::collection(CategoryForNews::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryForNewsRequest $request)
    {
        $data = $request->validated();
        $category_for_news = CategoryForNews::create($data);

        return new CategoryForNewsResource($category_for_news);
    }

    /**
     * Display the specified resource.
     */
    public function show(CategoryForNews $category_for_news): JsonResource
    {
        return JsonResource::make($category_for_news);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryForNewsRequest $request, CategoryForNews $category_for_news)
    {
        $data = $request->validated();
        $category_for_news->update($data);

        return new CategoryForNewsResource($category_for_news);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoryForNews $category_for_news)
    {
        $category_for_news->delete();
        return response()->noContent();
    }
}
