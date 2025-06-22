<?php

namespace Database\Factories;

use App\Models\Tour;
use Illuminate\Database\Eloquent\Factories\Factory;

class TourImageFactory extends Factory
{
    public function definition(): array
    {
        return [
            'image_url' => $this->faker->imageUrl(640, 480, 'travel', true),
        ];
    }
}
