<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Electrónica', 'description' => 'Gadgets y dispositivos electrónicos'],
            ['name' => 'Libros', 'description' => 'Diversos tipos de libros'],
            ['name' => 'Ropa', 'description' => 'Ropa para hombres y mujeres'],
            ['name' => 'Hogar y Cocina', 'description' => 'Electrodomésticos y utensilios de cocina'],
            ['name' => 'Juguetes y Juegos', 'description' => 'Juguetes y juegos para niños y adultos'],
            ['name' => 'Belleza y Cuidado Personal', 'description' => 'Productos de belleza y cuidado personal'],
            ['name' => 'Deportes y Aire Libre', 'description' => 'Equipos deportivos y artículos para actividades al aire libre'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
