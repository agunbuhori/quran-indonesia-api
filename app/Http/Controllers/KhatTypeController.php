<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKhatTypeRequest;
use App\Http\Requests\UpdateKhatTypeRequest;
use App\Http\Resources\KhatTypeResource;
use App\Models\KhatType;

class KhatTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return KhatTypeResource::collection(KhatType::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKhatTypeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(KhatType $khatType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KhatType $khatType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKhatTypeRequest $request, KhatType $khatType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KhatType $khatType)
    {
        //
    }
}
