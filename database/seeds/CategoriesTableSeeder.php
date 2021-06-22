<?php

use Illuminate\Database\Seeder;
use App\Category;
use Illuminate\Support\Str;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Antipasti',
            'Primi',
            'Secondi',
            'Contorni',
            'Dolci'
        ];

        // nell'array categories prendo ogni singolo elemento che si riferisce al nome della categoria 
        foreach($categories as $category_name) {
            // ad ogni giro del ciclo creo una categoria
            $new_category = new Category();
            $new_category->name = $category_name;
            $new_category->slug = Str::slug($new_category->name, '-');
            $new_category->save();

        }   
    }
}
