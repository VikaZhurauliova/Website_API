<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\ProductParamResource;
use App\Models\Param;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductParamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        return ProductParamResource::collection(Param::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $param = Param::create([
            'name' => $data['name']
        ]);

        return new ProductParamResource($param);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $product_params)
    {
        $param = Param::findOrFail($product_params);
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $param->update([
            'name' => $request->input('name'),
        ]);

        return new ProductParamResource($param);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($product_params)
    {
        $param = Param::findOrFail($product_params);
        $param->delete();
        return response()->noContent();
    }
}
