<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\RentTypeResource;
use App\Models\RentType;
use Illuminate\Http\Request;

class RentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return RentTypeResource::collection(RentType::paginate());
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
    public function show(int $id): RentTypeResource
    {
        return new RentTypeResource(RentType::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RentType $rent_type)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RentType $rent_type)
    {
        //
    }
}
