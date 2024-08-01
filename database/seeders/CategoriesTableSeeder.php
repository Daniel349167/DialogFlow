<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Electronics', 'description' => 'Electronic gadgets and devices'],
            ['name' => 'Books', 'description' => 'Various kinds of books'],
            ['name' => 'Clothing', 'description' => 'Men and Women clothing'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
