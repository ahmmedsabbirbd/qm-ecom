<?php

namespace Database\Seeders;

use App\Models\Product_detail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class Product_detailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $product_detailsJson = File::get('database/json/product-details.json');
        $product_details = collect( json_decode($product_detailsJson) );

        $product_details->each(function ($product_detail) {
            Product_detail::create([
                'img1'=>  $product_detail->img1,
                'img2'=> $product_detail->img2,
                'img3'=> $product_detail->img3,
                'img4'=> $product_detail->img4,
                'des'=> $product_detail->des,
                'color'=> $product_detail->color,
                'size'=> $product_detail->size,
                'product_id'=>$product_detail->product_id
            ]);
        });
    }
}
