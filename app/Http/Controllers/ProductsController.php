<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('id', 'DESC')->paginate(7);
        $categories = Category::orderBy('name')->get(['name', 'id']);

        return view('products.index', compact('products', 'categories'));
    }
}
