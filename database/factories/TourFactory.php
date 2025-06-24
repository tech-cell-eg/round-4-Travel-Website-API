<?php

namespace Database\Factories;

use App\Models\Destination;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TourFactory extends Factory
{
    public function definition(): array
    {
        $title = $this->faker->sentence(4);
        return [
            'category_id' => rand(1, 10),
            'title' => $title,
            'slug' => Str::slug($title . '-' . uniqid()),
            'overview' => $this->faker->paragraph(),
            'duration_days' => $this->faker->numberBetween(1, 7),
            'group_size' => $this->faker->numberBetween(5, 30),
            'age' => ['min' => 12, 'max' => 60],
            'languages' => [$this->faker->languageCode(), 'en'],
            'highlights' => $this->faker->sentences(3),
            'included' => [
                'Hotel pickup',
                'Guide',
                'Lunch',
                'Insurance',
                'Snacks'
            ],
            'itinerary' => [
                'Day 1: ' . $this->faker->sentence(),
                'Day 2: ' . $this->faker->sentence(),
                'Day 3: ' . $this->faker->sentence()
            ],
            'notes' => ['Free cancellation 24h before', 'Bring passport'],
            'price_adult' => $this->faker->randomFloat(2, 100, 400),
            'price_youth' => $this->faker->randomFloat(2, 50, 200),
            'price_child' => $this->faker->randomFloat(2, 20, 100),
            'extra_service_booking' => $this->faker->randomFloat(2, 10, 50),
            'extra_service_adult' => $this->faker->randomFloat(2, 5, 25),
            'extra_service_youth' => $this->faker->randomFloat(2, 5, 20),
            'available_from' => now(),
            'available_to' => now()->addMonths(2),
            'rating' => $this->faker->randomFloat(1, 3.5, 5.0),
            'review_count' => $this->faker->numberBetween(0, 1000),
        ];
    }
}
