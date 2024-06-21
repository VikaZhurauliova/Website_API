<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\ProductStatusResource;
use App\Models\ProductStatus;
use Illuminate\Http\Request;

class ProductStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return ProductStatusResource::collection(ProductStatus::paginate());
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
    public function show(int $id): ProductStatusResource
    {
        return new ProductStatusResource(ProductStatus::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductStatus $product_status)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductStatus $product_status)
    {
        //
    }
}
