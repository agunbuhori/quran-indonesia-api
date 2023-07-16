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
        return Cache::remember('juz', now()->addYear(1), function () {
            $juzs = [];

            foreach (range(1, 30) as $juz) {
                $ayahStart = Ayah::where('juz_number', $juz)->limit(1)->first();
                $ayahEnd = Ayah::where('juz_number', $juz)->orderBy('id', 'desc')->limit(1)->first();

                $juzs[] = [
                    'juz' => $juz,
                    'ayah_start' => "{$ayahStart->surah_id}:{$ayahStart->ayah_number}",
                    'ayah_end' => "{$ayahEnd->surah_id}:{$ayahEnd->ayah_number}",
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
        $results = Surah::whereHas('ayahs', function ($query) use ($request) {
            return $query
                ->join('translations AS t', 't.translatable_id', '=', 'ayahs.id')
                ->where('t.translatable_type', 'App\Models\Ayah')
                ->where('t.translation_version_id', 1)
                ->whereFullText('t.text', $request->q);
        })
            ->get();


        foreach ($results as $result) {
            $result->ayahs = $result->ayahs()
                ->join('translations AS t', 't.translatable_id', '=', 'ayahs.id')
                ->join('khats AS k', 'k.khatable_id', '=', 'ayahs.id')
                ->where('t.translatable_type', 'App\Models\Ayah')
                ->where('k.khatable_type', 'App\Models\Ayah')
                ->where('t.translation_version_id', 1)
                ->where('k.khat_type_id', 5)
                ->whereFullText('t.text', $request->q)
                ->select('t.text as text', 'ayah_number', 'surah_id', 'k.text as khat')
                ->get()
                ->each(function ($item) use ($request) {
                    foreach (explode(' ', $request->q) as $word) {
                        $word = strtolower($word);
                        $item->text = str_replace($word, "<b style='color: #ffe282;'>{$word}</b>", $item->text);
                        $word = ucfirst($word);
                        $item->text = str_replace($word, "<b style='color: #ffe282;'>{$word}</b>", $item->text);
                    }
                });
        }

        return SearchResource::collection($results);
    }
}
