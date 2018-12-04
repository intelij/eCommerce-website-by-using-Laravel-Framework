<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Banner;

class IndexController extends Controller
{
    public function index()
    {
        $productsAll = Product::orderBy('id', 'DESC')->where('status', 1)->get();

        // $productsAll = Product::inRandomOrder()->get();

        // Get all Categories and Sub Categories
        $categories = Category::with('categories')->where(['parent_id' => 0])->get();

        $banners = Banner::where('status', '1')->get();

        return view('index')->with(compact('productsAll', 'categories', 'banners'));
    }
}
