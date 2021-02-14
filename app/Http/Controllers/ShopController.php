<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    //
    public function index() {
        //Definitions
        $pagination = 9;
        $categories = Category::all();
        $products = Product::all();

        if(request()->category) {
            $products = Product::with('categories')->whereHas('categories', function($query) {
                $query->where('slug', request()->category);
            });
            $categoryName = optional($categories->where('slug', request()->category)->first())->name;
        } else {
            $products = Product::where('featured', true);
            $categoryName = 'Featured Products';
        }

        if(request()->sort == 'low_high') {
            $products = $products->orderBy('price')->paginate($pagination);
        } elseif(request()->sort == 'high_low') {
            $products = $products->orderBy('price', 'DESC')->paginate($pagination);
        } else {
            $products = $products->paginate($pagination);
        }

        return view('shop', compact('products', 'categories', 'categoryName'));
    }

    public function show($slug) {
        $product = Product::where('slug', $slug)->firstOrFail();

        return view('product', compact('product'));
    }
}
