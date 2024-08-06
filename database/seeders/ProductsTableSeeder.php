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
            ['name' => 'Portátil', 'description' => 'Un potente portátil', 'quantity' => 10, 'category_id' => Category::where('name', 'Electrónica')->first()->id],
            ['name' => 'Smartphone', 'description' => 'Un smartphone con las últimas características', 'quantity' => 20, 'category_id' => Category::where('name', 'Electrónica')->first()->id],
            ['name' => 'Libro de Ciencia Ficción', 'description' => 'Un emocionante libro de ciencia ficción', 'quantity' => 30, 'category_id' => Category::where('name', 'Libros')->first()->id],
            ['name' => 'Novela de Fantasía', 'description' => 'Una emocionante novela de fantasía', 'quantity' => 25, 'category_id' => Category::where('name', 'Libros')->first()->id],
            ['name' => 'Camiseta', 'description' => 'Una cómoda camiseta', 'quantity' => 50, 'category_id' => Category::where('name', 'Ropa')->first()->id],
            ['name' => 'Jeans', 'description' => 'Un par de jeans elegantes', 'quantity' => 40, 'category_id' => Category::where('name', 'Ropa')->first()->id],
            ['name' => 'Licuadora', 'description' => 'Una licuadora de alta velocidad', 'quantity' => 15, 'category_id' => Category::where('name', 'Hogar y Cocina')->first()->id],
            ['name' => 'Cafetera', 'description' => 'Una cafetera con temporizador', 'quantity' => 12, 'category_id' => Category::where('name', 'Hogar y Cocina')->first()->id],
            ['name' => 'Figura de Acción', 'description' => 'Una figura de acción coleccionable', 'quantity' => 25, 'category_id' => Category::where('name', 'Juguetes y Juegos')->first()->id],
            ['name' => 'Juego de Mesa', 'description' => 'Un divertido juego de mesa familiar', 'quantity' => 30, 'category_id' => Category::where('name', 'Juguetes y Juegos')->first()->id],
            ['name' => 'Shampoo', 'description' => 'Un shampoo nutritivo', 'quantity' => 40, 'category_id' => Category::where('name', 'Belleza y Cuidado Personal')->first()->id],
            ['name' => 'Hidratante', 'description' => 'Una crema hidratante', 'quantity' => 35, 'category_id' => Category::where('name', 'Belleza y Cuidado Personal')->first()->id],
            ['name' => 'Balón de Baloncesto', 'description' => 'Un balón de baloncesto de tamaño estándar', 'quantity' => 20, 'category_id' => Category::where('name', 'Deportes y Aire Libre')->first()->id],
            ['name' => 'Tienda de Campaña', 'description' => 'Una tienda de campaña para dos personas', 'quantity' => 10, 'category_id' => Category::where('name', 'Deportes y Aire Libre')->first()->id],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
