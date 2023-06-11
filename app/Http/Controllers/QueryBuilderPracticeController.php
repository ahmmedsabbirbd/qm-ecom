<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QueryBuilderPracticeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return key pair value all record in coulm name 
        // $products = DB::table('categories')->pluck('categoryImage', 'categoryName');
        

        // return unicq value
        // $products = DB::table('products')->select('title')->distinct()->get();

        // return max value
        // $products = DB::table('products')->max('price');

        // return min value
        // $products = DB::table('products')->min('price');

        // return avg value
        // $products = DB::table('products')->avg('price');
    
        // return all record sum value
        // $products = DB::table('products')->sum('price');
    
        // return left join 
        // $products = DB::table('products')
        // ->leftJoin('brands', 'products.brand_id', 'brands.id')
        // ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
        // ->select('products.id', 'products.title', 'products.short_des', 'products.price', 'products.discount',  'products.discount_price',  'products.image',  'products.stock',  'products.star',  'products.remark', 'brands.brandName', 'brands.brandImage', 'categories.categoryName','categories.categoryImage', 'products.created_at', 'products.updated_at')
        // ->orderBy('products.id', 'asc')
        // ->get();
        
        // return right join 
        // $products = DB::table('products')
        // ->rightJoin('brands', 'products.brand_id', 'brands.id')
        // ->rightJoin('categories', 'products.category_id', '=', 'categories.id')
        // ->select('products.id', 'products.title', 'products.short_des', 'products.price', 'products.discount',  'products.discount_price',  'products.image',  'products.stock',  'products.star',  'products.remark', 'brands.brandName', 'brands.brandImage', 'categories.categoryName','categories.categoryImage', 'products.created_at', 'products.updated_at')
        // ->orderBy('products.id', 'asc')
        // ->get();
        
        // return right join 
        // $products = DB::table('products')
        // ->crossJoin('brands')
        // ->crossJoin('categories')
        // ->select('products.id', 'products.title', 'products.short_des', 'products.price', 'products.discount',  'products.discount_price',  'products.image',  'products.stock',  'products.star',  'products.remark', 'brands.brandName', 'brands.brandImage', 'categories.categoryName','categories.categoryImage', 'products.created_at', 'products.updated_at')
        // ->orderBy('products.id', 'asc')
        // ->get();

        // didnot understand properly
        // // return union
        // $price = DB::table('products')->select('price'); 
        // $products = DB::table('products')->select('title')->union($price)->get();

        //  decrement
        // $products = DB::table('products')
        // ->where('id', 10)
        // ->decrement('price', '30916');
        
        //  decrement
        // $products = DB::table('products')
        // ->where('id', 10)
        // ->increment('price', '10');

        //  truncate // delete all record and staring id 1
        // $products = DB::table('product_wishes')
        // ->truncate();

        //  decrement
        $products = DB::table('brands')
        ->updateOrInsert(
            ['brandName'=>'Apple'],
            ['brandName'=>'Apple'],
        );

        // $totalProducts = $products->count();

        if(!$products) {
            return Response()->json([
                'success'=>false,
                'messeage'=>'Data not found'
            ]);
        } else {
            return Response()->json([
                'success'=>true,
                // 'total-products'=> $totalProducts,
                'messeage'=>$products
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
