<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SeoRequest;
use App\Http\Resources\Admin\SeoResource;
use App\Models\Seo;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class SeoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        return SeoResource::collection(Seo::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Seo $seo): JsonResource
    {
        return SeoResource::make($seo->load('seoMeta'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SeoRequest $request, Seo $seo)
    {
        $data = $request->validated();
        $seo->update($data);

        return SeoResource::make($seo);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Seo $seo)
    {
        //
    }
}
