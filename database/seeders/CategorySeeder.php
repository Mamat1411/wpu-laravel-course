<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Category::factory(3)->create();

        Category::create([
            'name' => 'Full Stack Programming',
            'slug' => 'full-stack-programming',
            'color' => 'bg-green-100 text-green-800'
        ]);

        Category::create([
            'name' => 'Back End Programming',
            'slug' => 'back-end-programming',
            'color' => 'bg-red-100 text-red-800'
        ]);

        Category::create([
            'name' => 'Front End Programming',
            'slug' => 'front-end-programming',
            'color' => 'bg-violet-100 text-violet-800'
        ]);

        Category::create([
            'name' => 'UI UX Design',
            'slug' => 'ui-ux-design',
            'color' => 'bg-orange-100 text-orange-800'
        ]);

        Category::create([
            'name' => 'Dev Ops',
            'slug' => 'dev-ops',
            'color' => 'bg-blue-100 text-blue-800'
        ]);
    }
}
