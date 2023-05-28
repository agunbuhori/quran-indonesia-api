<?php

namespace App\Http\Controllers;

use App\Http\Requests\JuzRequest;
use App\Http\Requests\StoreSurahRequest;
use App\Http\Requests\SurahDetailRequest;
use App\Http\Requests\UpdateSurahRequest;
use App\Http\Resources\AyahsResource;
use App\Http\Resources\JuzAyahsResource;
use App\Http\Resources\JuzResource;
use App\Http\Resources\SurahAyahsResource;
use App\Http\Resources\SurahResource;
use App\Models\Ayah;
use App\Models\Surah;
use Illuminate\Database\Eloquent\Collection;

class SurahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return SurahResource::collection(Surah::all());
    }

    /**
     * Display a listing of the resource.
     */
    public function show(SurahDetailRequest $request, Surah $surah)
    {
        return SurahAyahsResource::make($surah);
    }

    /**
     * Display a listing of the resource.
     */
    public function juz()
    {
        $juzs = [];

        foreach (range(1, 30) as $juz) {
            $ayahStart = Ayah::where('juz_number', $juz)->limit(1)->first();
            $ayahEnd = Ayah::where('juz_number', $juz)->orderBy('id', 'desc')->limit(1)->first();

            $juzs[] = [
                'juz' => $juz,
                'ayah_start' => "{$ayahStart->surah_id}:{$ayahStart->verse_number}",
                'ayah_end' => "{$ayahEnd->surah_id}:{$ayahEnd->verse_number}",
            ];
        }

        return new JuzResource($juzs);
    }

    /**
     * Display a listing of the resource.
     */
    public function show_juz(JuzRequest $request, int $juz)
    {
        return new JuzAyahsResource($juz);
    }
}
