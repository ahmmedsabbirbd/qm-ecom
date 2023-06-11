<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBrandRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        
        $brands = DB::table('brands')
        ->orderBy('brandName', 'asc')
        ->get();

        if(!$brands || $brands->count() == 0) {
            return Response()->json([
                'success'=>false,
                'message'=>'Data not found'
            ]);
        } else {
            return Response()->json([
                'success'=>true,
                'message'=>$brands
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
    public function store(StoreBrandRequest $request)
    {
        if($request->validated()) {
            // only insert
            $brand = DB::table('brands')
            ->insert([
                'brandName'=>$request->input('brandName'),
                'brandImage'=>$request->input('brandImage')
            ]);

            // $brand = DB::table('brands')
            // ->updateOrInsert([
            //     'brandName'=>$request->input('brandName'),
            //     'brandImage'=>$request->input('brandImage')
            // ], [
            //     'brandName'=>$request->input('brandName'),
            // ]);

            if(!$brand) {
                return Response()->json([
                    'success'=>false,
                    'message'=>'Data not created'
                ]);
            } else {
                return Response()->json([
                    'success'=>true,
                    'message'=>$brand
                ], 201, [
                    'token'=> 'dsf23212'
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $brands = DB::table('brands')
        ->where('id', $id)
        ->first();

        if(!$brands) {
            return Response()->json([
                'success'=>false,
                'message'=>'Data not found'
            ]);
        } else {
            return Response()->json([
                'success'=>true,
                'message'=>$brands
            ]);
        }
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
        $brands = DB::table('brands')
        ->where('id', $id)
        ->delete();

        if(!$brands) {
            return Response()->json([
                'success'=>false,
                'message'=>'Data not found'
            ]);
        } else {
            return Response()->json([
                'success'=>true,
                'message'=>$brands
            ]);
        }
    }
}
