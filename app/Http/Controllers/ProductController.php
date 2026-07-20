<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        if ($search) {
            $products = Product::where('name', 'like', '%' . $search . '%')->get();
        } else {
            $products = Product::all();
        }
        
        return view('home', compact('products', 'search'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('product.detail', compact('product'));
    }
}
