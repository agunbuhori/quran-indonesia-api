<?php

namespace Database\Seeders;

use App\Models\Topic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $topics = [
            'Tauhid',
            'Syirik',
            'Rizki',
            'Musibah'
        ];

        foreach ($topics as $topic) {
            Topic::create(['title' => $topic]);
        }
    }
}
