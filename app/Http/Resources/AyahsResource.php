<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AyahsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $data = [
            ...parent::toArray($request)
        ];

        if ($request->with_khat) {
            $data['khat'] = $this->khat;
        }

        if ($request->with_kalimahs) {
            $data['kalimahs'] = $this->kalimahs()->with('translation')->get();
        }

        if ($request->with_translation) {
            $data['translation'] = $this->translation;
        }

        if ($request->with_surah) {
            $data['surah'] = $this->surah;
        }

        return $data;
    }
}
