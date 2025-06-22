<?php

namespace Database\Seeders;

use App\Models\Destination;
use App\Models\Tour;
use Illuminate\Database\Seeder;

class MassiveTourSeeder extends Seeder
{
    public function run(): void
    {
        Destination::factory()
            ->count(20)
            ->create()
            ->each(function ($destination) {
                // Create 50 tours for each destination
                $destination->tours()->saveMany(
                    Tour::factory()->count(50)->make()
                );
            });
    }
}
