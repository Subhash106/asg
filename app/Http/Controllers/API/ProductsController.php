<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return response()->json($request->all());
        $validator = Validator::make($request->all(), [
            'category' => 'required|numeric',
            'name' => 'required',
            'price' => 'required|numeric'
        ]);

        if($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()], 422);
        }

        $product = Product::create(['name'=>$request->name, 'category_id'=>$request->category, 'price'=>$request->price]);

        return response()->json(['product'=>$product], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required|numeric',
            'name' => 'required',
            'price' => 'required|numeric'
        ]);

        if($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()], 422);
        }

        $product = Product::where('id', $id)->first();

        if(!$product)
        {
            return response()->json(['errors'=>['Resource Not Found!']], 404);   
        }

        $product->name = $request->name;
        $product->category_id = $request->category;
        $product->price = $request->price;
        $product->save();

        return response()->json(['product'=>$product], 200);
    }
    
}
