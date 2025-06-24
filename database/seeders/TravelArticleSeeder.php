<?php

namespace Database\Seeders;

use App\Models\TravelArticle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TravelArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TravelArticle::factory()->count(30)->create();

    }
}
