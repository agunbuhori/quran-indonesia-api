<?php

namespace Database\Seeders;

use App\Models\Kalimah;
use App\Models\Khat;
use App\Models\Translation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class TranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::transaction(function () {
        //     $versions = [33, 141, 174, 134];
        //     foreach ($versions as $vid => $version) {
        //         try {
        //             $request = Http::get("https://api.quran.com/api/v4/quran/translations/$version");
        //             foreach ($request['translations'] as $key => $translation) {
        //                 Translation::create([
        //                     'text' => $translation['text'],
        //                     'translatable_id' => $key + 1,
        //                     'translatable_type' => 'App\Models\Ayah',
        //                     'translation_version_id' => $vid + 1
        //                 ]);
        //             }
        //         } catch (\Throwable $th) {
        //             throw $th;
        //         }
        //     }
        // });

        DB::transaction(function () {
            foreach (range(1, 114) as $surah) {
                try {
                    $request = Http::get("https://api.qurancdn.com/api/qdc/verses/by_chapter/$surah?words=true&translation_fields=resource_name%2Clanguage_id&per_page=300&fields=text_uthmani%2Cchapter_id%2Chizb_number%2Ctext_imlaei_simple&translations=131&reciter=7&word_translation_language=id&page=1&word_fields=verse_key%2Cverse_id%2Cpage_number%2Clocation%2Ctext_uthmani%2Cqpc_uthmani_hafs&mushaf=5");

                    foreach ($request['verses'] as $verse) {
                        foreach ($verse['words'] as $key => $word) {
                            $kalimah = Kalimah::where([
                                'ayah_id' => $word['verse_id'],
                                'position' => $key + 1,
                            ])->first();

                            // $kalimah->text_uthmani = $word['text_uthmani'];
                            // $kalimah->text_uthmani_hafs = $word['qpc_uthmani_hafs'];
                            // $kalimah->save();

                            // Translation::updateOrCreate([
                            //     'translatable_type' => 'App\Models\Kalimah',
                            //     'translatable_id' => $kalimah->id,
                            // ], [
                            //     'translation_version_id' => 1,
                            //     'text' => $word['translation']['text'],
                            // ]);

                            // Khat::updateOrCreate([
                            //     'khatable_type' => 'App\Models\Kalimah',
                            //     'khatable_id' => $kalimah->id,
                            // ], [
                            //     'khat_type_id' => 1,
                            //     'text' => $word['text_uthmani'],
                            // ]);
                        }
                    }
                } catch (\Throwable $th) {
                    throw $th;
                }
            }
        });
    }
}
