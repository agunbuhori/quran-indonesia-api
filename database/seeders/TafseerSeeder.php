<?php

namespace Database\Seeders;

use App\Models\Ayah;
use App\Models\Tafseer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class TafseerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        function sanitize($text)
        {
            $text = str_replace(' SWT', ' <i>Subhanahu wata\'ala</i>', $text);
            $text = str_replace(' Swt.', ' <i>Subhanahu wata\'ala</i>', $text);
            $text = str_replace(' Saw.',  ' ﷺ', $text);
            $text = str_replace(' a.s.', ' <i>alaihis salam</i>', $text);

            return $text;
        }
        // DB::transaction(function () {

        try {
            foreach (range(1, 114) as $surah) {
                $request = Http::get("https://api.qurancdn.com/api/qdc/tafsirs/ar-tafsir-al-wasit/by_chapter/$surah?locale=en&words=true&word_fields=verse_key%2Cverse_id%2Cpage_number%2Clocation%2Ctext_uthmani%2Ccode_v2%2Cqpc_uthmani_hafs&mushaf=1&per_page=300");
                foreach ($request['tafsirs'] as $key => $tafsir) {
                    $ayah = Ayah::where(['surah_id' => $surah, 'ayah_number' => $key + 1])->first();
                    Tafseer::updateOrCreate([
                        'ayah_id' => $ayah->id,
                        'book_id' => 13,
                    ], [
                        'text' => $tafsir['text']
                    ]);
                }
            }
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
        // });
    }
}
