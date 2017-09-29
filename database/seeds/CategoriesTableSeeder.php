<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $category = new Category();
        $category->name = 'Movies';
        $category->save();
    }
}