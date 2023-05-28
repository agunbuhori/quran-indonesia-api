<?php

namespace Database\Seeders;

use App\Models\Translation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class TranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $versions = [33, 141, 174, 134];

        foreach ($versions as $vid => $version) {
            try {
                $request = Http::get("https://api.quran.com/api/v4/quran/translations/$version");
                foreach ($request['translations'] as $key => $translation) {
                    Translation::create([
                        'text' => $translation['text'],
                        'translatable_id' => $key + 1,
                        'translatable_type' => 'App\Models\Ayah',
                        'translation_version_id' => $vid + 1
                    ]);
                }
            } catch (\Throwable $th) {
                throw $th;
            }
        }
    }
}
