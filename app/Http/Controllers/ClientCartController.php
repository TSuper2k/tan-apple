<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class ClientCartController extends Controller
{
    public function index(){
        $categoriesLimit = Category::where('parent_id', 0)->take(5)->get();
        return view('client.product.cart.cart', compact('categoriesLimit'));
    }

    
}
