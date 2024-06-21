<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\BrandResource;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BrandController extends Controller
{
    /**
     * Список всех брендов
     */
    public function index(): AnonymousResourceCollection
    {
        return BrandResource::collection(Brand::all());
    }

    /**
     *
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $brand = Brand::create([
            'name' => $data['name']
        ]);

        return new BrandResource($brand);
    }

    /**
     *
     * Display the specified resource.
     */
    public function show(int $id): BrandResource
    {
        return new BrandResource(Brand::findOrFail($id));
    }

    /**
     *
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $brand->update([
            'name' => $request->input('name'),
        ]);

        return ['data' => $brand];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        if ($brand->products()->exists()) {
            return response()->json(['message' => 'Бренд связан с товарами'], 422);
        }

        $brand->delete();

        return response()->noContent();
    }
}
