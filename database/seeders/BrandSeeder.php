<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brandsJson = File::get('database/json/brands.json');
        $brands = collect( json_decode($brandsJson) );

        $brands->each(function ($brand) {
            Brand::create([
                'brandName'=>$brand->brandName,
                'brandImage'=>$brand->brandImage
            ]);
        });
    }
}
