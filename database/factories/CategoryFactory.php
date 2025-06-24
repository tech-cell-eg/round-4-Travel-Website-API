<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = [
            'Adventure',
            'Cultural',
            'Sightseeing',
            'Beach',
            'Wildlife',
            'Hiking',
            'Cruise',
            'City Tour',
            'Desert Safari',
            'Historical',
            'Food & Drink'
        ];

        $name = $this->faker->unique()->randomElement($types);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
        ];
    }

}
