<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "title" => fake()->sentence,
            "excerpt" => fake()->text,
            "slug" => fake()->slug,
            "body" => fake()->realTextBetween(),
            "published_at" => fake()->dateTime,
            "user_id" => User::factory()->create(),
            "category_id" => Category::factory()->create(),
        ];
    }
}
