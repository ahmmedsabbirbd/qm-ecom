<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoriesJson = File::get('database/json/categories.json');
        $categories = collect( json_decode($categoriesJson) );

        $categories->each(function ($category) {
            Category::create([
                'categoryName'=> $category->categoryName,
                'categoryImage'=> $category->categoryImage
            ]);
        });
    }
}
