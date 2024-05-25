<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductTrashRequest;
use App\Http\Requests\UpdateProductTrashRequest;
use App\Models\ProductTrash;

class ProductTrashController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductTrashRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductTrashRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductTrash  $productTrash
     * @return \Illuminate\Http\Response
     */
    public function show(ProductTrash $productTrash)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductTrash  $productTrash
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductTrash $productTrash)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductTrashRequest  $request
     * @param  \App\Models\ProductTrash  $productTrash
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductTrashRequest $request, ProductTrash $productTrash)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductTrash  $productTrash
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductTrash $productTrash)
    {
        //
    }
}
