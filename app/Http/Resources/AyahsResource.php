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
            ...parent::toArray($request),
            'khat' => $this->khat
        ];

        if ($request->with_kalimahs) {
            $data['kalimahs'] = $this->kalimahs()->with('khat', 'translation')->get();
        }

        if ($request->with_translation) {
            $data['translation'] = $this->translation;
        }

        return $data;
    }
}
