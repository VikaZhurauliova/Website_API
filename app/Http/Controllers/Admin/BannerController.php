<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Banner\BannerSortRequest;
use App\Http\Requests\Admin\Banner\BannerUpdateRequest;
use App\Http\Resources\Admin\BannerResource;
use App\Models\Banner;
use App\Services\Admin\BannerService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        return BannerResource::collection(Banner::orderBy('position')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(): BannerResource
    {
        return BannerResource::make(BannerService::store());
    }

    /**
     * Display the specified resource.
     */
    public function show(Banner $banner): BannerResource
    {
        return BannerResource::make($banner);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BannerUpdateRequest $request, Banner $banner): BannerResource
    {
        $data = $request->validated();
        return BannerResource::make(BannerService::update($banner, $data))
            ->additional(['revalidatePath' => $banner->revalidate_path]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner): BannerResource
    {
        $banner->delete();
        return BannerResource::make($banner)
            ->additional(['revalidatePath' => $banner->revalidate_path]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function sort(BannerSortRequest $request): AnonymousResourceCollection|array
    {
        $ids = $request->validated()['ids'];
        BannerService::sort($ids);
        return BannerResource::collection(Banner::orderBy('position')->get())
            ->additional(['revalidatePath' => Banner::first()->revalidate_path]);
    }
}
