<?php

namespace Database\Seeders;

use App\Models\TranslationVersion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TranslationVersionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TranslationVersion::create([
            'name' => 'KEMENAG',
            'author' => 'Kementrian Agama Republik Indonesia'
        ]);

        TranslationVersion::create([
            'name' => 'Sabiq',
            'author' => 'The Sabiq Company'
        ]);

        TranslationVersion::create([
            'name' => 'Mukhtasar',
            'author' => 'Al-Mukhtasar'
        ]);

        TranslationVersion::create([
            'name' => 'King Fahd',
            'author' => 'King Fahad Quran Complex'
        ]);
    }
}
