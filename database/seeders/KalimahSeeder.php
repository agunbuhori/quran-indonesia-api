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
        DB::transaction(function () {
            foreach (range(1, 114) as $surah) {
                try {
                    $request = Http::get("https://api.quran.com/api/v4/verses/by_chapter/$surah?language=id&words=true&page=1&per_page=300&fields=1");

                    foreach ($request['verses'] as $verse) {
                        foreach ($verse['words'] as $word) {
                            Kalimah::create([
                                'ayah_id' => $verse['id'],
                                'position' => $word['position'],
                                'char_type_name' => $word['char_type_name'],
                                'page_number' => $word['page_number'],
                                'line_number' => $word['line_number'],
                                'text' => $word['text'],
                                'text_v2' => $word['text'],
                            ]);
                        }
                    }
                } catch (\Throwable $th) {
                    throw $th;
                }
            }
        });
    }
}
