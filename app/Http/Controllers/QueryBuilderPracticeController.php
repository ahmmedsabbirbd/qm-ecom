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

        if(!$products) {
            return Response()->json([
                'success'=>false,
                'messeage'=>'Data not found'
            ]);
        } else {
            return Response()->json([
                'success'=>true,
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
