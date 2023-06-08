<?php

namespace Database\Seeders;

use App\Models\Product_slider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class Product_sliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $product_slidersJson = File::get('database/json/product-sliders.json');
        $product_sliders = collect( json_decode($product_slidersJson) );

        $product_sliders->each(function ($product_slider) {
            Product_slider::create([
                'title'=> $product_slider->title,
                'short_des'=> $product_slider->short_des,
                'image'=> $product_slider->image,
                'product_id'=>$product_slider->product_id
            ]);
        });
    }
}
