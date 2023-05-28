<?php

namespace App\Http\Resources;

use App\Models\KhatType;
use App\Models\TranslationVersion;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SurahAyahsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            ...parent::toArray($request),
            'ayahs' => AyahsResource::collection($this->ayahs()->simplePaginate($request->per_page ?? 10)),

        ];
    }

    public function with(Request $request)
    {
        return [
            'meta' => [
                'page' => $request->page ?? 1,
                'per_page' => $request->per_page ?? 10,
                'khat_type' => KhatType::find($request->khat_version_id ?? 1),
                'translation_version' => TranslationVersion::find($request->translation_version_id ?? 1),
            ]
        ];
    }
}
