<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ClientCategoryController extends Controller
{
    public function index($slug, $categoryId){
        $categoriesLimit = Category::where('parent_id', 0)->take(5)->get();
        // $products = Product::where('category_id', $categoryId)->paginate(12);
        $categories = Category::where('parent_id', 0)->get();
        
        $category_by_slug = Category::where('slug', $slug)->get();

        $min_price = Product::min('price');
        $max_price = Product::max('price');
        $min_price_range = $min_price - 0;
        $max_price_range = $max_price + 10000000;

        foreach($category_by_slug as $key => $cate){
            $category_id = $cate->id;
        }

        if(isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];
            if($sort_by == 'tang_dan'){
                $category_by_id = Product::with('category')->where('category_id', $category_id)
                ->orderBy('price', 'ASC')->paginate(12)->appends(request()->query());
            } elseif($sort_by == 'giam_dan'){
                $category_by_id = Product::with('category')->where('category_id', $category_id)
                ->orderBy('price', 'DESC')->paginate(12)->appends(request()->query());
            } elseif($sort_by == 'kytu_az'){
                $category_by_id = Product::with('category')->where('category_id', $category_id)
                ->orderBy('name', 'ASC')->paginate(12)->appends(request()->query());
            } elseif($sort_by == 'kytu_za'){
                $category_by_id = Product::with('category')->where('category_id', $category_id)
                ->orderBy('name', 'DESC')->paginate(12)->appends(request()->query());
            } elseif(isset($_GET['start_price']) && $_GET['end_price']){
                $min_price = $_GET['start_price'];
                $max_price = $_GET['end_price'];

                $category_by_id = Product::with('category')->whereBetween('price', [$min_price, $max_price])
                ->orderBy('price', 'DESC')->paginate(12)->appends(request()->query());
            }
        } else{
            $category_by_id = Product::where('category_id', $categoryId)->paginate(12);
        }

        return view('client.product.category.list', compact('categoriesLimit', 'categories', 'category_by_id', 'min_price', 'max_price', 'max_price_range', 'min_price_range'));
    }
}
