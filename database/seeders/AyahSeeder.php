<?php

namespace Database\Seeders;

use App\Models\Ayah;
use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class AyahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            foreach (range(1, 114) as $surah) {
                try {
                    $request = Http::get("https://api.quran.com/api/v4/verses/by_chapter/$surah?translations=id&per_page=300");
                    foreach ($request['verses'] as $verse) {
                        Ayah::create([
                            'surah_id' => $surah,
                            'ayah_number' => $verse['verse_number'],
                            'hizb_number' => $verse['hizb_number'],
                            'rub_el_hizb_number' => $verse['rub_el_hizb_number'],
                            'ruku_number' => $verse['ruku_number'],
                            'manzil_number' => $verse['manzil_number'],
                            'sajdah_number' => $verse['sajdah_number'],
                            'page_number' => $verse['page_number'],
                            'juz_number' => $verse['juz_number'],
                        ]);
                    }
                } catch (Exception $e) {
                    throw new Exception($e->getMessage());
                }
            }
        });
    }
}
