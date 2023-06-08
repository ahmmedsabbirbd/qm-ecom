<?php

namespace App\Http\Controllers;

use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use League\CommonMark\Extension\Table\Table;
use PhpParser\Node\Stmt\Return_;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {  
        $allProduct = 'product not found';
        $category = $request->category;
        $brand = $request->brand;
        // show total products
        if($category) {
            $categoryId = DB::table('categories')->where('categoryName', '=', $category)->select('id')->first();

            if($categoryId) {   
                $allProduct = DB::table('products')
                ->where('category_id', '=', $categoryId->id)
                ->join('brands', 'products.brand_id', '=', 'brands.id')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->select('products.id', 'products.title', 'products.short_des', 'products.price', 'products.discount',  'products.discount_price',  'products.image',  'products.stock',  'products.star',  'products.remark', 'brands.brandName', 'brands.brandImage', 'categories.categoryName','categories.categoryImage', 'products.created_at', 'products.updated_at')
                ->orderBy('id', 'asc')
                ->get();
            }
        } else if($brand) {
            $brandId = DB::table('brands')->where('brandName', '=', $brand)->select('id')->first();

            if($brandId) {   
                $allProduct = DB::table('products')
                ->where('brand_id', '=', $brandId->id)
                ->join('brands', 'products.brand_id', '=', 'brands.id')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->select('products.id', 'products.title', 'products.short_des', 'products.price', 'products.discount',  'products.discount_price',  'products.image',  'products.stock',  'products.star',  'products.remark', 'brands.brandName', 'brands.brandImage', 'categories.categoryName','categories.categoryImage', 'products.created_at', 'products.updated_at')
                ->orderBy('id', 'asc')
                ->get();
            }
        } else {
            $allProduct = DB::table('products')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.id', 'products.title', 'products.short_des', 'products.price', 'products.discount',  'products.discount_price',  'products.image',  'products.stock',  'products.star',  'products.remark', 'brands.brandName', 'brands.brandImage', 'categories.categoryName','categories.categoryImage', 'products.created_at', 'products.updated_at')
            ->orderBy('id', 'asc')
            ->get();
        }

        $totalProduct = 0;
        if($allProduct && $allProduct != 'product not found') {
            $totalProduct = $allProduct->count();
        }

        return Response()->json([
            'total-products'=> $totalProduct,
            'products'=> $allProduct
        ]);
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
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // product find with id in find method
        // $product = DB::table('products')->find($id);
        
        // product find with id in where method
        $product = DB::table('products')
        ->where('products.id', '=', $id)
        ->join('brands', 'products.brand_id', '=', 'brands.id')
        ->join('categories', 'products.category_id', '=', 'categories.id')
        ->join('product_details', 'products.id', '=', 'product_details.product_id')
        ->select('products.id', 'products.title', 'products.short_des', 'products.price',
            'products.discount',  'products.discount_price',  'products.image',  'products.stock',  'products.star',  'products.remark',
            'product_details.color', 'product_details.size', 'product_details.des',  'product_details.img1', 'product_details.img2', 'product_details.img3', 'product_details.img4',
            'brands.brandName', 'brands.brandImage',
            'categories.categoryName','categories.categoryImage',
            'products.created_at', 'products.updated_at')
        ->get();

        // product find with id in where method
        $product_details = DB::table('products')
        ->where('products.id', '=', $id)
        ->join('product_details', 'products.id', '=', 'product_details.product_id')
        ->select('product_details.color', 'product_details.size', 'product_details.des',  'product_details.img1', 'product_details.img2', 'product_details.img3', 'product_details.img4')
        ->get();

        return Response()->json([
            'status'=> 'success',
            'data'=> [
                'product'=> $product,
                'product-details'=> $product_details
            ]
        ]);
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
