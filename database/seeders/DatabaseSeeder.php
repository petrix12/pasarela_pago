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
        Storage::deleteDirectory('products');
        Storage::deleteDirectory('articles');

        Storage::makeDirectory('products');
        Storage::makeDirectory('articles');

        Product::factory(10)->create();

        // Productos: 
        /* Product::create([
            'title' => 'Análisis por semana',
            'image' => 'products/producto01.png',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab dicta officiis explicabo quisquam recusandae tenetur voluptatibus architecto earum fugiat deserunt error dolor corporis, esse placeat vitae dolore. Aut, fuga officiis.',
            'price' => 59
        ]);
        
        Product::create([
            'title' => 'Carta de Naturaleza',
            'image' => 'products/producto02.png',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur ipsum laboriosam repellat, corrupti architecto eveniet quisquam placeat mollitia magnam hic adipisci eligendi assumenda accusamus cupiditate tempora ipsam culpa asperiores provident.',
            'price' => 99
        ]);

        Product::create([
            'title' => 'Fase de Genealogía',
            'image' => 'products/producto03.png',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo minima ipsum enim consequuntur aliquid atque tenetur officia, illo sequi assumenda nihil, doloremque quam, ut tempora! Adipisci recusandae quidem iste repudiandae!',
            'price' => 149
        ]);

        Product::create([
            'title' => 'Memorándum Administrativo',
            'image' => 'products/producto04.png',
            'description' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptatum nobis beatae dicta sit quisquam ipsum ea alias totam quod dolorum earum eius minus distinctio, sequi debitis esse iste. Doloribus, vel!',
            'price' => 99
        ]);

        Product::create([
            'title' => 'Nacionalidad Italiana',
            'image' => 'products/producto05.png',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde tenetur, laborum facilis nisi iure ipsam inventore error minus sed vel praesentium, ad sint id. Reprehenderit voluptates repellat iste facilis nobis?',
            'price' => 19
        ]);

        Product::create([
            'title' => 'Nacionalidad Portuguesa',
            'image' => 'products/producto06.png',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus soluta voluptatum est. Ut provident, nihil velit nulla, alias ex modi illum veritatis similique, dolorum tempore expedita quidem iste excepturi corrupti.',
            'price' => 49
        ]);

        Product::create([
            'title' => 'Recurso de Alzada',
            'image' => 'products/producto07.png',
            'description' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. A repudiandae, ea ipsam expedita minus fugiat omnis voluptates, vitae cupiditate voluptatibus quis eius itaque unde pariatur. Reprehenderit atque facere vero sed?',
            'price' => 99
        ]);

        Product::create([
            'title' => 'Resolución Expresa',
            'image' => 'products/producto08.png',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex quae impedit nesciunt veniam, aliquid dolorem ad sed id illo? Vitae voluptatibus, recusandae molestiae ex rerum nulla esse eos eveniet dolores?',
            'price' => 99
        ]);

        Product::create([
            'title' => 'Servicio de Residencias',
            'image' => 'products/producto09.png',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio at exercitationem blanditiis odit quam hic eaque aut facere rerum eius. Facere ex nemo modi. Animi corrupti molestias cupiditate in doloremque.',
            'price' => 49
        ]);

        Product::create([
            'title' => 'Subsanación de Expediente',
            'image' => 'products/producto10.png',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet quibusdam provident voluptatibus similique dicta dolor illum quidem minima quaerat totam omnis laudantium, officiis nostrum ipsa autem eius dolorem vero modi?',
            'price' => 19
        ]); */

        // Artículos: 
        Article::factory(10)->create();
    }
}
