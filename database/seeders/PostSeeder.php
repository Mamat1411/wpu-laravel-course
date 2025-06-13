<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Using inRandomOrder Approach
        // Post::factory(50)->create();

        // Using Recycle Approach
        Post::factory(50)->recycle([
            User::all(),
            Category::all()
        ])->create();
    }
}
