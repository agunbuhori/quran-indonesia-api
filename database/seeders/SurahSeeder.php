<?php

namespace Database\Seeders;

use App\Models\Surah;
use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use PDOException;

class SurahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        function sanitizeName($string): string
        {
            $string = str_replace('sh', 'sy', $string);
            $string = str_replace('Sh', 'Sy', $string);
            $string = str_replace('aw', 'au', $string);

            return $string;
        }

        try {
            // DB::table('surahs')->truncate();
            $json = Http::get('https://api.quran.com/api/v4/chapters?language=id');
            $chapters = $json['chapters'];

            foreach ($chapters as $chapter) {
                Surah::create([
                    'revelation_order' => $chapter['revelation_order'],
                    'revelation_place' => $chapter['revelation_place'],
                    'bismillah' => $chapter['bismillah_pre'],
                    'name_simple' => sanitizeName($chapter['name_simple']),
                    'name_complex' => sanitizeName($chapter['name_complex']),
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
