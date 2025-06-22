<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Destination>
 */
class DestinationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->city();
        return [
            'name' => $name,
            'image_url' => $this->faker->imageUrl(640, 480, 'city', true, $name),
            'slug' => Str::slug($name),
            'description' => $this->faker->paragraph(),
            'country' => $this->faker->country(),
            'city' => $name,
        ];
    }
}
