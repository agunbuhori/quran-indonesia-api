<?php

namespace Database\Seeders;

use App\Models\Surah;
use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use PDOException;

class SurahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            $json = Http::get('https://api.quran.com/api/v4/chapters?language=id');
            $chapters = $json['chapters'];

            foreach ($chapters as $chapter) {
                Surah::create([
                    'revelation_order' => $chapter['revelation_order'],
                    'revelation_place' => $chapter['revelation_place'],
                    'bismillah' => $chapter['bismillah_pre'],
                    'name_simple' => $chapter['name_simple'],
                    'name_complex' => $chapter['name_complex'],
                    'name_arabic' => $chapter['name_arabic'],
                    'name_indonesian' => $chapter['translated_name']['name'],
                    'pages' => $chapter['pages'],
                ]);
            }
        } catch (\PDOException $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
