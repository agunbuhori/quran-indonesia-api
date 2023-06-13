<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTafseerRequest;
use App\Http\Requests\UpdateTafseerRequest;
use App\Http\Resources\TafseerResource;
use App\Models\Ayah;
use App\Models\Tafseer;

class TafseerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreTafseerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($surah, $ayah)
    {
        $ayah = Ayah::where(['surah_id' => $surah, 'ayah_number' => $ayah])->firstOrfail();
        $tafseer = Tafseer::where(['ayah_id' => $ayah->id, 'book_id' => request('book_id') ?? 1])->first();
        return TafseerResource::make($tafseer);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tafseer $tafseer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTafseerRequest $request, Tafseer $tafseer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tafseer $tafseer)
    {
        //
    }
}
