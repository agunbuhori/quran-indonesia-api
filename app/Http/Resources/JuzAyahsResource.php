<?php

namespace App\Http\Resources;

use App\Models\Ayah;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JuzAyahsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $ayahStart = Ayah::where('juz_number', $this->resource)->limit(1)->first();
        $ayahEnd = Ayah::where('juz_number', $this->resource)->orderBy('id', 'desc')->limit(1)->first();

        return [
            'juz' => $this->resource,
            'ayah_start' => "{$ayahStart->surah_id}:{$ayahStart->verse_number}",
            'ayah_end' => "{$ayahEnd->surah_id}:{$ayahEnd->verse_number}",
            'ayahs' => AyahsResource::collection(Ayah::where('juz_number', $this->resource)->simplePaginate($request->per_page ?? 10))
        ];
    }

    public function with(Request $request)
    {
        return [
            'meta' => [
                'page' => $request->page ?? 1,
                'per_page' => $request->per_page ?? 10,
            ]
        ];
    }
}
