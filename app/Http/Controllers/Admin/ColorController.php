<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Color\ColorUpdateRequest;
use App\Http\Resources\Admin\ColorResource;
use App\Models\Color;
use App\Services\Admin\ColorService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        return ColorResource::collection(Color::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(): ColorResource
    {
        return ColorResource::make(ColorService::store());
    }

    /**
     * Display the specified resource.
     */
    public function show(Color $color): ColorResource
    {
        return ColorResource::make($color);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ColorUpdateRequest $request, Color $color): ColorResource
    {
        $data = $request->validated();
        return  ColorResource::make(ColorService::update($color, $data));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}
