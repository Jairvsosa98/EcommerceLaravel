<?php

namespace Database\Seeders;

use App\Models\Subcategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subcategories = [

            // Celulares y Tablets
            [
                'category_id' => 1,
                'name' => 'Celulares y Smartphones',
                'slug' => Str::slug('Celulares y Smartphones'),
                'color' => true
            ],
            [
                'category_id' => 1,
                'name' => 'Accesorios para Celulares',
                'slug' => Str::slug('Accesorios para Celulares')
            ],
            [
                'category_id' => 1,
                'name' => 'SmartWatches',
                'slug' => Str::slug('SmartWatches')
            ],
            
            // TV, Audio y Video
            [
                'category_id' => 2,
                'name' => 'TV y Audio',
                'slug' => Str::slug('TV y Audio')
            ],
            [
                'category_id' => 2,
                'name' => 'Audios',
                'slug' => Str::slug('Audios')
            ],
            [
                'category_id' => 2,
                'name' => 'Audio para automóviles',
                'slug' => Str::slug('Audio para automóviles')
            ],

            // Consola y Videojuegos
            [
                'category_id' => 3,
                'name' => 'Xbox',
                'slug' => Str::slug('Xbox')
            ],
            [
                'category_id' => 3,
                'name' => 'Play Station',
                'slug' => Str::slug('Play Station')
            ],
            [
                'category_id' => 3,
                'name' => 'Videojuegos para PC',
                'slug' => Str::slug('Videojuegos para PC')
            ],
            [
                'category_id' => 3,
                'name' => 'Nintendo',
                'slug' => Str::slug('Nintendo')
            ],

            // Computación
            [
                'category_id' => 4,
                'name' => 'Portátiles',
                'slug' => Str::slug('Portátiles')
            ],
            [
                'category_id' => 4,
                'name' => 'PC de Escritorio',
                'slug' => Str::slug('PC de Escritorio')
            ],
            [
                'category_id' => 4,
                'name' => 'Almacenamiento',
                'slug' => Str::slug('Almacenamiento')
            ],
            [
                'category_id' => 4,
                'name' => 'Accesorios para Computadoras',
                'slug' => Str::slug('Accesorios para Computadoras')
            ],

            // Moda
            [
                'category_id' => 5,
                'name' => 'Mujeres',
                'slug' => Str::slug('Mujeres'),
                'color' => true,
                'size' => true
            ],
            [
                'category_id' => 5,
                'name' => 'Hombres',
                'slug' => Str::slug('Hombres'),
                'color' => true,
                'size' => true
            ],
            [
                'category_id' => 5,
                'name' => 'Lentes',
                'slug' => Str::slug('Lentes'),
                'color' => true,
                'size' => true
            ],
            [
                'category_id' => 5,
                'name' => 'Relojes',
                'slug' => Str::slug('Relojes'),
                'color' => true,
                'size' => true
            ],
        ];
        foreach ($subcategories as $subcategory) {
            Subcategory::create($subcategory);
        }
    }
}
