<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        $products = [
            ['name' => 'Laptop', 'description' => 'A powerful laptop', 'quantity' => 10, 'category_id' => Category::where('name', 'Electronics')->first()->id],
            ['name' => 'Smartphone', 'description' => 'A smartphone with latest features', 'quantity' => 20, 'category_id' => Category::where('name', 'Electronics')->first()->id],
            ['name' => 'Science Fiction Book', 'description' => 'An exciting sci-fi book', 'quantity' => 30, 'category_id' => Category::where('name', 'Books')->first()->id],
            ['name' => 'Fantasy Novel', 'description' => 'A thrilling fantasy novel', 'quantity' => 25, 'category_id' => Category::where('name', 'Books')->first()->id],
            ['name' => 'T-Shirt', 'description' => 'A comfortable t-shirt', 'quantity' => 50, 'category_id' => Category::where('name', 'Clothing')->first()->id],
            ['name' => 'Jeans', 'description' => 'A pair of stylish jeans', 'quantity' => 40, 'category_id' => Category::where('name', 'Clothing')->first()->id],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
