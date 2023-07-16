<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAyahRequest;
use App\Http\Requests\UpdateAyahRequest;
use App\Http\Resources\AyahsResource;
use App\Models\Ayah;
use App\Models\Kalimah;

class AyahController extends Controller
{

    public function page(int $page)
    {
        $kalimahs = Kalimah::where('page_number', $page)->select('text_v2 as text', 'line_number')->get();


        $lines = [];

        foreach (range(1, 15) as $line) {
            $lines[$line] = [];
        }

        foreach ($kalimahs as $kalimah) {
            $lines[$kalimah->line_number][] = $kalimah->text;
        }


        // foreach ($lines as $key => $line) {
        //     if (count($line) === 0) {
        //         if (isset($lines[$key - 1]) && $lines[$key - 1][0] === 'surah_name') {
        //             $lines[$key] = ['bismillah'];
        //         } else {
        //             $lines[$key] = ['surah_name'];
        //         }
        //     } else {
        //         $lines[$key] = array_reverse($lines[$key]);
        //     }
        // }

        return $lines;
    }
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
    public function store(StoreAyahRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($surah, $ayah)
    {
        $ayah = Ayah::where(['surah_id' => $surah, 'ayah_number' => $ayah])->firstOrFail();
        return AyahsResource::make($ayah);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ayah $ayah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAyahRequest $request, Ayah $ayah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ayah $ayah)
    {
        //
    }
}
