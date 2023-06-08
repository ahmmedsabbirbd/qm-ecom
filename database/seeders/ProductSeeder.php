<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productsJson = File::get('database/json/products.json');
        $products = collect( json_decode($productsJson) );

        $products->each(function ($product) {
            Product::create([
                'title'=> $product->title,
                'short_des'=> $product->short_des,
                'price'=> $product->price,
                'discount'=> $product->discount,
                'discount_price'=> $product->discount_price,
                'image'=> $product->image,
                'stock'=> $product->stock,
                'star'=> $product->star,
                'remark'=> $product->remark,
                'category_id'=> $product->category_id,
                'brand_id'=> $product->brand_id
            ]);
        });
    }
}
