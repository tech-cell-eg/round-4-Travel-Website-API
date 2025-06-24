<?php

namespace Database\Seeders;

use App\Models\Destination;
use App\Models\Tour;
use App\Models\TourImage;
use Illuminate\Database\Seeder;

class MassiveTourSeeder extends Seeder
{
    public function run(): void
    {
        Destination::factory()
        ->count(20)
        ->create()
        ->each(function ($destination) {

            $tours = Tour::factory()
                ->count(rand(10, 50))
                ->make();

            $destination->tours()->saveMany($tours);

            $tours->each(function ($tour) {
                $tour->images()->saveMany(
                    TourImage::factory()->count(rand(2, 5))->make([
                        'image_url' => 'tours_img/tour.png',
                    ])
                );
            });
        });
    }
}
