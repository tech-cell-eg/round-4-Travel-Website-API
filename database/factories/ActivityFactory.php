<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Activity>
 */
class ActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence(3);
        return [
            'destination_id' => rand(1, 20), // ربط عشوائي بأي مكان من الـ 20
            'title' => $title,
            'slug' => Str::slug($title . '-' . uniqid()),
            'image_url' => $this->faker->imageUrl(640, 480, 'travel', true),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(2, 20, 200),
            'rating' => $this->faker->randomFloat(1, 3.5, 5.0),
            'review_count' => $this->faker->numberBetween(0, 1000),
        ];
    }


}
