<?php

namespace Database\Seeders;

use App\Models\Ayah;
use App\Models\Tafseer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
            $text = str_replace(' Swt.', '<i>Subhanahu wata\'ala</i>', $text);
            $text = str_replace(' Saw.', 'ﷺ', $text);
            $text = str_replace(' a.s.', '<i>alaihis salam</i>', $text);

            return $text;
        }
        try {
            $request = Http::get('https://api-quran.bekalislam.id/kathir.json');
            foreach ($request['data'] as $data) {
                $ayah = Ayah::where(['ayah_number' => $data['noayat'], 'surah_id' => $data['nosurat']])->first();
                if ($ayah) {
                    Tafseer::updateOrCreate([
                        'ayah_id' => $ayah->id,
                        'book_id' => 6,
                    ], [
                        'text' => sanitize($data['tafsir'])
                    ]);
                }
            }
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
