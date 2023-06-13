<?php

namespace Database\Seeders;

use App\Models\Khat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class KhatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::transaction(function () {
            $khats = ['uthmani', 'uthmani_simple', 'uthmani_tajweed', 'indopak', 'imlaei'];
            foreach ($khats as $key => $khat) {

                try {
                    $request = Http::get("https://api.quran.com/api/v4/quran/verses/$khat");
                    foreach ($request['verses'] as $verse) {
                        Khat::create([
                            'khat_type_id' => $key + 1,
                            'text' => $verse['text_' . $khat],
                            'khatable_id' => $verse['id'],
                            'khatable_type' => 'App\Models\Ayah'
                        ]);
                    }
                } catch (\Throwable $th) {
                    throw $th;
                }
            }
        });
    }
}
