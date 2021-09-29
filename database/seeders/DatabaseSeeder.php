<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        /* Storage::deleteDirectory('products');
        Storage::deleteDirectory('articles');

        Storage::makeDirectory('products');
        Storage::makeDirectory('articles');

        Product::factory(10)->create(); */

        // Productos: 
        Product::create([
            'title' => 'Análisis por semana',
            'image' => 'products/producto01.png',
            'description' => $this->faker->text(),
            'price' => $this->faker->randomElement([19, 49, 99])
        ]);

        Product::create([
            'title' => 'Carta de Naturaleza',
            'image' => 'products/producto02.png',
            'description' => $this->faker->text(),
            'price' => $this->faker->randomElement([19, 49, 99])
        ]);

        Product::create([
            'title' => 'Fase de Genealogía',
            'image' => 'products/producto03.png',
            'description' => $this->faker->text(),
            'price' => $this->faker->randomElement([19, 49, 99])
        ]);

        Product::create([
            'title' => 'Memorándum Administrativo',
            'image' => 'products/producto04.png',
            'description' => $this->faker->text(),
            'price' => $this->faker->randomElement([19, 49, 99])
        ]);

        Product::create([
            'title' => 'Nacionalidad Italiana',
            'image' => 'products/producto05.png',
            'description' => $this->faker->text(),
            'price' => $this->faker->randomElement([19, 49, 99])
        ]);

        Product::create([
            'title' => 'Nacionalidad Portuguesa',
            'image' => 'products/producto06.png',
            'description' => $this->faker->text(),
            'price' => $this->faker->randomElement([19, 49, 99])
        ]);

        Product::create([
            'title' => 'Recurso de Alzada',
            'image' => 'products/producto07.png',
            'description' => $this->faker->text(),
            'price' => $this->faker->randomElement([19, 49, 99])
        ]);

        Product::create([
            'title' => 'Resolución Expresa',
            'image' => 'products/producto08.png',
            'description' => $this->faker->text(),
            'price' => $this->faker->randomElement([19, 49, 99])
        ]);

        Product::create([
            'title' => 'Servicio de Residencias',
            'image' => 'products/producto09.png',
            'description' => $this->faker->text(),
            'price' => $this->faker->randomElement([19, 49, 99])
        ]);

        Product::create([
            'title' => 'Subsanación de Expediente',
            'image' => 'products/producto10.png',
            'description' => $this->faker->text(),
            'price' => $this->faker->randomElement([19, 49, 99])
        ]);

        // Artículos: 
        Article::factory(10)->create();
    }
}
