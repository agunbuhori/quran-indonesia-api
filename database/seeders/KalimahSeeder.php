<?php

namespace Database\Seeders;

use App\Models\Ayah;
use App\Models\Kalimah;
use App\Models\Khat;
use App\Models\Translation;
use App\Models\Transliteration;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class KalimahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::transaction(function () {
        foreach (range(1, 114) as $surah) {
            try {
                $request = Http::get("https://api.qurancdn.com/api/qdc/verses/by_chapter/$surah?words=true&translation_fields=resource_name%2Clanguage_id&per_page=300&fields=text_uthmani%2Cchapter_id%2Chizb_number%2Ctext_imlaei_simple&translations=131%2C174%2C33%2C134%2C141&reciter=7&word_translation_language=en&page=1&word_fields=verse_key%2Cverse_id%2Cpage_number%2Clocation%2Ctext_uthmani%2Ccode_v1%2Cqpc_uthmani_hafs&mushaf=2");

                foreach ($request['verses'] as $verse) {
                    foreach ($verse['words'] as $word) {
                        Kalimah::where(['ayah_id' => $word['verse_id'], 'position' => $word['position']])
                            ->update([
                                'text' => $word['code_v1'],
                                'page_number' => $word['page_number'],
                                'line_number' => $word['line_number']
                            ]);
                    }
                }
            } catch (\Throwable $th) {
                throw $th;
            }
        }
        // });
    }
}
