<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // Data kategori dari SQL dump
        $categories = [
            ['name' => 'flatshoes', 'slug' => 'flatshoes'],
            ['name' => 'Heels', 'slug' => 'heels'],
            ['name' => 'Wedding Heels', 'slug' => 'wedding-heels'],
            ['name' => 'Sneakers', 'slug' => 'sneakers'],
            ['name' => 'Boots', 'slug' => 'boots'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['slug' => $category['slug']],
                ['name' => $category['name']]
            );
        }
    }
}