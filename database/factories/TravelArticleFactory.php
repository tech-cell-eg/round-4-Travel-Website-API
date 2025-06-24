<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TravelArticle>
 */
class TravelArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence();
        return [
            'title' => $title,
            'slug' => Str::slug($title . '-' . uniqid()),
            'image_url' => $this->faker->imageUrl(800, 600, 'nature', true),
            'content' => $this->faker->paragraphs(6, true),
            'author' => $this->faker->name(),
            'tags' => [$this->faker->word(), $this->faker->word()],
            'views_count' => $this->faker->numberBetween(0, 5000),
            'published_at' => now(),
        ];
    }
}
