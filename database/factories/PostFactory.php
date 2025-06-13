<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Str;
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
    public function definition(): array
    {
        $title = fake()->unique()->sentence(mt_rand(1, 8));

        // Using inRandomOrder Approach
        // return [
        //     'title' => $title,
        //     'author_id' => User::inRandomOrder()->first()->id,
        //     'category_id' => Category::inRandomOrder()->first()->id,
        //     'slug' => Str::slug($title),
        //     'body' => fake()->realText()
        // ];

        // Using Recycle Approach
        return [
            'title' => $title,
            'author_id' => User::factory(),
            'category_id' => Category::factory(),
            'slug' => Str::slug($title),
            'body' => fake()->realText()
        ];
    }
}
