<?php

namespace App\Http\Controllers;

use App\Http\Requests\JuzRequest;
use App\Http\Requests\SearchAyahRequest;
use App\Http\Requests\StoreSurahRequest;
use App\Http\Requests\SurahDetailRequest;
use App\Http\Requests\UpdateSurahRequest;
use App\Http\Resources\AyahsResource;
use App\Http\Resources\JuzAyahsResource;
use App\Http\Resources\JuzResource;
use App\Http\Resources\SearchResource;
use App\Http\Resources\SurahAyahsResource;
use App\Http\Resources\SurahResource;
use App\Models\Ayah;
use App\Models\Surah;
use App\Models\Translation;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class SurahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Cache::remember('surah', now()->addYear(1), function () {
            return SurahResource::collection(Surah::all());
        });
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
        return Cache::remember('juz', now()->addYear(1), function () {
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
        });
    }

    /**
     * Display a listing of the resource.
     */
    public function show_juz(JuzRequest $request, int $juz)
    {
        return new JuzAyahsResource($juz);
    }

    /**
     * Display a listing of the resource.
     */
    public function search(SearchAyahRequest $request)
    {
        $result = Surah::whereHas('ayahs', function ($query) use ($request) {
            return $query
                ->join('translations AS t', 't.translatable_id', '=', 'ayahs.id')
                ->whereFullText('t.text', $request->q);
        })
            ->get();


        return SearchResource::collection($result);
    }
}
