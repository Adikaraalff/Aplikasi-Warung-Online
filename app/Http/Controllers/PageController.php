<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){
        $Product = Product::all();
        return view('pages.index',compact('Product'));
    }
}
