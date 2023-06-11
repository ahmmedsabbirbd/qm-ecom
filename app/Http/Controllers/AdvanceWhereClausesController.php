<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdvanceWhereClausesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // orWhere
        // $products = DB::table('products')
        // ->where('products.price', '<=', '20000')
        // ->orWhere('products.short_des', 'LIKE', '%affordable smartphone%')
        // ->orderBy('id', 'asc')
        // ->get();

        // whereNot
        // $products = DB::table('products')
        // ->where('products.price', '<=', '20000')
        // ->whereNot('products.short_des', 'LIKE', '%zzzzzz%')
        // ->orderBy('id', 'asc')
        // ->get();
        // ->get();

        // whereBetween
        // $products = DB::table('products')
        // ->whereBetween('products.price', [20, 50000])
        // ->orderBy('id', 'asc')
        // ->get();
        
        // whereNotBetween
        // $products = DB::table('products')
        // ->whereNotBetween('products.price', [20, 50000])
        // ->orderBy('id', 'asc')
        // ->get();

        // not understand
        // whereBetweenColumns
        // $products = DB::table('products')
        // ->whereBetweenColumns('products.price', ['products.id', 'products.discount_price'],)
        // ->orderBy('id', 'asc')
        // ->get();

        // whereIn
        // $products = DB::table('products')
        // ->whereIn('products.price', [20, ])
        // ->orWhere('products.discount_price', '>', '1000')
        // ->orderBy('id', 'asc')
        // ->get();
        
        // whereNotIn
        // $products = DB::table('products')
        // ->whereNotIn('products.price', [20])
        // ->orWhere('products.discount_price', '>', '1000')
        // ->orderBy('id', 'asc')
        // ->get();
        
        // // whereNotNull
        // $products = DB::table('products')
        // ->whereNotNull('products.price')
        // ->orderBy('id', 'asc')
        // ->get();

        //  whereDate
        // $products = DB::table('products')
        // ->whereDate('created_at', '2023-06-15')
        // ->get();

        //  whereMonth
        // $products = DB::table('products')
        // ->whereMonth('created_at', '05')
        // ->get();

        //  whereDay
        // $products = DB::table('products')
        // ->whereDay('created_at', '15')
        // ->get();

        //  whereYear
        // $products = DB::table('products')
        // ->whereYear('created_at', '2022')
        // ->get();
        
        //  whereTime
        // $products = DB::table('products')
        // ->whereTime('created_at', '01:29:23')
        // ->get();
        
        //  whereColumn
        // $products = DB::table('products')
        // ->whereColumn('created_at', '<', 'updated_at')
        // ->get();


        //  orderBy
        // $products = DB::table('products')
        // ->orderBy('title', 'asc')
        // ->get();
        
        //  inRandomOrder
        // $products = DB::table('products')
        // ->inRandomOrder()
        // ->get();


        //  latest work for created_at
        // $products = DB::table('products')
        // ->latest()
        // ->get();
        
        // oldest work for created_at
        // $products = DB::table('products')
        // ->oldest()
        // ->get();

        // groupBy
        // 'strict' => false, // default true, i use groupby for i do false
        // $products = DB::table('products')
        // ->groupBy('title')
        // ->get();

        // groupBy with having
        // 'strict' => false, // default true, i use groupby for i do false
        // $products = DB::table('products')
        // ->groupBy('title')
        // ->having('price', '=', '60916')
        // ->get();


        // skip and take
        $products = DB::table('products')
        ->skip(1)
        ->take(15)
        ->get();
        
        if(!$products || $products->count() == 0) {
            return Response()->json([
                'success'=>false, 
                'message'=>'Data not found' 
            ]);    
        }

        return Response()->json([
            'success'=> true,
            'total-products'=>$products->count(),
            'message'=> $products
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
