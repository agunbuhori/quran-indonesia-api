<?php

namespace App\Http\Resources;

use App\Models\Ayah;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JuzResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return parent::toArray($request);
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
