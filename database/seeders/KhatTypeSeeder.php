<?php

namespace Database\Seeders;

use App\Models\KhatType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KhatTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = ['Uthmani', 'Uthmani Simple', 'Uthmani Tajweed', 'Indopak', 'Imlai', 'Imlai Simple'];

        foreach ($names as $name) {
            KhatType::create([
                'name' => $name
            ]);
        }
    }
}
