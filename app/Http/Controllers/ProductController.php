<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductDetailRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Contracts\Database\Eloquent\Builder;
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
        $category = $request->category;
        $brand = $request->brand;
        $price = $request->price;
        
        // show total products
        if($category) {   
            $allProduct = DB::table('categories')
            ->where('categories.categoryName', '=', $category)
            ->join('products', 'categories.id', '=', 'products.category_id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->select('products.id', 'products.title', 'products.short_des', 'products.price', 'products.discount',  'products.discount_price',  'products.image',  'products.stock',  'products.star',  'products.remark', 'brands.brandName', 'brands.brandImage', 'categories.categoryName','categories.categoryImage', 'products.created_at', 'products.updated_at')
            ->orderBy('id', 'asc')
            ->get();
        } else if($price) {
            // equal to =
            // not equal to !=
            // less than <
            // less than or equal to  <=
            //  greather than  >
            // greather than or equal to  >=
            // LIKE (contains)  %a%, %a, a%
            // NOT LIKE (does not contains)  %a%, %a, a%
            // IN (is in list)  [a, b]
            // NOT IN (is not in list)  [a, b]

            $priceText = $request->input('price');
            $priceText = str_replace("'", '', $priceText);
            $price = explode(',', $priceText);

            if('max' == $price[0]) {
                $allProduct = DB::table('products')
                ->join('brands', 'products.brand_id', '=', 'brands.id')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->select('products.id', 'products.title', 'products.short_des', 'products.price', 'products.discount',  'products.discount_price',  'products.image',  'products.stock',  'products.star',  'products.remark', 'brands.brandName', 'brands.brandImage', 'categories.categoryName','categories.categoryImage', 'products.created_at', 'products.updated_at')
                ->orderBy('products.price', 'desc')
                ->get();
            } else if('min' == $price[0]) { 
                $allProduct = DB::table('products')
                ->join('brands', 'products.brand_id', '=', 'brands.id')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->select('products.id', 'products.title', 'products.short_des', 'products.price', 'products.discount',  'products.discount_price',  'products.image',  'products.stock',  'products.star',  'products.remark', 'brands.brandName', 'brands.brandImage', 'categories.categoryName','categories.categoryImage', 'products.created_at', 'products.updated_at')
                ->orderBy('products.price', 'asc')
                ->get();
            } else { 
                if(count($price) == 3) {
                    if('left' == $price[2]) {
                        $allProduct = DB::table('products')
                        ->join('brands', function(JoinClause $join) use ($price) {
                            $join->on('products.brand_id', '=', 'brands.id')->where('products.price', $price[1], "%$price[0]");
                        })
                        ->join('categories', 'products.category_id', '=', 'categories.id')
                        ->select('products.id', 'products.title', 'products.short_des', 'products.price', 'products.discount',  'products.discount_price',  'products.image',  'products.stock',  'products.star',  'products.remark', 'brands.brandName', 'brands.brandImage', 'categories.categoryName','categories.categoryImage', 'products.created_at', 'products.updated_at')
                        ->orderBy('products.price', 'asc')
                        ->get();
                    } else if ('right' == $price[2]) {
                        $allProduct = DB::table('products')
                        ->join('brands', function(JoinClause $join) use ($price) {
                            $join->on('products.brand_id', '=', 'brands.id')->where('products.price', $price[1], "$price[0]%");
                        })
                        ->join('categories', 'products.category_id', '=', 'categories.id')
                        ->select('products.id', 'products.title', 'products.short_des', 'products.price', 'products.discount',  'products.discount_price',  'products.image',  'products.stock',  'products.star',  'products.remark', 'brands.brandName', 'brands.brandImage', 'categories.categoryName','categories.categoryImage', 'products.created_at', 'products.updated_at')
                        ->orderBy('products.price', 'asc')
                        ->get();
                    } else if('all' == $price[2]) {
                        $allProduct = DB::table('products')
                        ->join('brands', function(JoinClause $join) use ($price) {
                            $join->on('products.brand_id', '=', 'brands.id')->where('products.price', $price[1], "%$price[0]%");
                        })
                        ->join('categories', 'products.category_id', '=', 'categories.id')
                        ->select('products.id', 'products.title', 'products.short_des', 'products.price', 'products.discount',  'products.discount_price',  'products.image',  'products.stock',  'products.star',  'products.remark', 'brands.brandName', 'brands.brandImage', 'categories.categoryName','categories.categoryImage', 'products.created_at', 'products.updated_at')
                        ->orderBy('products.price', 'asc')
                        ->get();
                    } else {
                        $allProduct = null;
                    }
                } else {
                    $allProduct = DB::table('products')
                    ->join('brands', function(JoinClause $join) use ($price) {
                        $join->on('products.brand_id', '=', 'brands.id')->where('products.price', $price[1], $price[0]);
                    })
                    ->join('categories', 'products.category_id', '=', 'categories.id')
                    ->select('products.id', 'products.title', 'products.short_des', 'products.price', 'products.discount',  'products.discount_price',  'products.image',  'products.stock',  'products.star',  'products.remark', 'brands.brandName', 'brands.brandImage', 'categories.categoryName','categories.categoryImage', 'products.created_at', 'products.updated_at')
                    ->orderBy('products.price', 'asc')
                    ->get();
                }
            }
        } else if($price) {
            $allProduct = DB::table('categories')
            ->where('categories.categoryName', '=', $category)
            ->join('products', 'categories.id', '=', 'products.category_id')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->select('products.id', 'products.title', 'products.short_des', 'products.price', 'products.discount',  'products.discount_price',  'products.image',  'products.stock',  'products.star',  'products.remark', 'brands.brandName', 'brands.brandImage', 'categories.categoryName','categories.categoryImage', 'products.created_at', 'products.updated_at')
            ->orderBy('id', 'asc')
            ->get();
        } else {
            $allProduct = DB::table('products')
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.id', 'products.title', 'products.short_des', 'products.price', 'products.discount',  'products.discount_price',  'products.image',  'products.stock',  'products.star',  'products.remark', 'brands.brandName', 'brands.brandImage', 'categories.categoryName','categories.categoryImage', 'products.created_at', 'products.updated_at')
            ->orderBy('id', 'asc')
            ->get();
        }

        if(!$allProduct || $allProduct->count() == 0) {
            return Response()->json([
                'success'=>false,
                'message'=>'Data no found'
            ]);
        }
        
        $totalProduct = $allProduct->count();
        return Response()->json([
            'success'=>true,
            'message'=>'Product found',
            'total-products-count'=> $totalProduct,
            'total-products'=> $allProduct,
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
    public function store(StoreProductRequest $request)
    {
        DB::table('products')
        ->insert([
            'title'=> $request->input('title'),
            'short_des'=> $request->input('short_des'),
            'price'=> $request->input('price'),
            'discount'=> $request->input('discount'),
            'discount_price'=> $request->input('discount_price'),
            'image'=> $request->input('image'),
            'stock'=> $request->input('stock'),
            'star'=> $request->input('star'),
            'remark'=> $request->input('remark'),
            'category_id'=> $request->input('category_id'),
            'brand_id'=> $request->input('brand_id')
        ]);

        if(!$request->validated()) {
            return Response()->json([
                'success'=>false,
                'message'=>'Data not found!'
            ]);
        } else {
            return Response()->json([
                'success'=>true,
                'message'=>'Product added!'
            ]);
        }
        
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
        ->select('products.id', 'products.title', 'products.short_des', 'products.price',
            'products.discount',  'products.discount_price',  'products.image',  'products.stock',  'products.star',  'products.remark',
            'brands.brandName', 'brands.brandImage',
            'categories.categoryName','categories.categoryImage',
            'products.created_at', 'products.updated_at')
        ->first();

        // product find with id in where method
        $product_details = DB::table('products')
        ->where('products.id', '=', $id)
        ->join('product_details', 'products.id', '=', 'product_details.product_id')
        ->select('product_details.color', 'product_details.size', 'product_details.des',  'product_details.img1', 'product_details.img2', 'product_details.img3', 'product_details.img4')
        ->first();

        if(!$product) {
            return Response()->json([
                'success'=>false,
                'message'=>'data no found'
            ]);
        }

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
    public function update(UpdateProductRequest $request, string $id)
    {
        DB::table('products')
        ->where('id', '=', $id)
        ->update($request->input());

        // if(!$request->validated()) {
        //     return Response()->json([
        //         'success'=>false,
        //         'message'=>'Data not found!'
        //     ]);
        // } else {
        //     return Response()->json([
        //         'success'=>true,
        //         'message'=>'Product updated!'
        //     ]);
        // }

        return Response()->json([
            'success'=>true,
            'message'=>'Product updated!'
        ]);
    }
    
    /*
    * product details
    */
   public function productDetails(string $id)
   {
        $products = DB::table('products')
        ->where('products.id', '=', $id)
        ->first();

        if($products) {
            $productDetails = DB::table('products')
            ->where('products.id', '=', $id)
            ->join('brands', 'products.brand_id', '=', 'brands.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('product_details', 'products.id', '=', 'product_details.product_id')
            ->select(
                'products.id', 'products.title', 'products.short_des', 'products.price',
                'products.discount',  'products.discount_price',  'products.image',  'products.stock',  'products.star',  'products.remark',
                'brands.brandName', 'brands.brandImage',
                'categories.categoryName','categories.categoryImage',
                'product_details.color', 'product_details.size', 'product_details.des',  'product_details.img1', 'product_details.img2', 'product_details.img3', 'product_details.img4',
                'products.created_at', 'products.updated_at',
            )
            ->first();   
        }

        if(!$products) {
            return Response()->json([
                'success'=>false,
                'message'=>'Product din not found!'
            ]);
        }
        
        if(!$productDetails) {
           return Response()->json([
                'success'=>false,
                'message'=>'Product details din not found!'
            ]);
        }
    
       return Response()->json([
           'success'=>true,
           'message'=>$productDetails
       ]);
   }
    
   /*
    * product details add
    */
   public function productDetailsAdd(StoreProductDetailRequest $request)
   {
        if($request->validated()) {
            $productDetails = DB::table('product_details')
            ->insert([
                'img1'=> $request->input('img1'),
                'img2'=> $request->input('img2'),
                'img3'=> $request->input('img3'),
                'img4'=> $request->input('img4'),
                'des'=> $request->input('des'),
                'color'=> $request->input('color'),
                'size'=> $request->input('size'),
                'product_id'=> $request->input('product_id'),
            ]);

            if(!$productDetails) {   
                return Response()->json([
                    'success'=>false,
                    'message'=>'Data not found!'
                ]);
            } else {
                return Response()->json([
                    'success'=>true,
                    'message'=>'Product Details added!'
                ]);
            }
        }
        
   }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = DB::table('products')->where('id', '=', $id)->delete();

        if(!$product) {
            return Response()->json([
                'success'=>false,
                'message'=>'Data not found!'
            ]);
        }
        
        return Response()->json([
            'success'=>true,
            'message'=>'Product deleted!'
        ]);
    }
}
