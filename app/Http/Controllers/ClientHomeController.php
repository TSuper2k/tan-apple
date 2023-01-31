<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Facade;
use PHPUnit\Framework\Constraint\Count;

class ClientHomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::latest()->get();
        $categories = Category::where('parent_id', 0)->get();
        $productsRecommend = Product::latest()->take(12)->get();
        $products = Product::latest('views_count', 'desc')->take(6)->get();
        $categoriesLimit = Category::where('parent_id', 0)->take(5)->get();

        // $categoryTab = Category::join('products', 'categories.id', '=', 'products.category_id')
        // ->select('categories.*', 'products.*')
        // ->where('parent_id', '>', 0)
        // ->get();

        $categoryTab = Category::where('parent_id', '>', 0)->get();

        // dd($categoryTab);

        return view('client.home.home', compact('sliders', 'categories', 'products', 'productsRecommend', 'categoriesLimit', 'categoryTab'));
    }

    public function detail(Request $request, $slug, $id)
    {
        $product_detail = Product::where('slug', $slug)->where('id', $id)->get();

        $categoriesLimit = Category::where('parent_id', 0)->take(5)->get();
        $categories = Category::where('parent_id', 0)->get();
        $productsRecommend = Product::latest('views_count', 'desc')->take(12)->get();

        $product_image_detail = DB::table('product_images')->join('products', 'products.id', '=', 'product_images.product_id')
        ->select('products.*', 'product_images.*')
        ->where('products.id', $id)
        ->get();

        $product = Product::where('id', $id)->first();
        $product->views_count = $product->views_count + 1;
        $product->save();

        // dd($product_image_detail);

        return view('client.product.detail.detail', compact('product_image_detail', 'product_detail', 'categories', 'categoriesLimit', 'productsRecommend'));
    }

    public function search(Request $request){
        $categoriesLimit = Category::where('parent_id', 0)->take(5)->get();
        $categories = Category::where('parent_id', 0)->get();
        $productsRecommend = Product::latest('views_count', 'desc')->take(12)->get();

        $keyWords = $request->keywords_submit;
        $searchProduct = Product::where('name', 'like', '%' .$keyWords. '%')->get();
        

        return view('client.product.search.search', compact('categoriesLimit', 'categories', 'productsRecommend', 'searchProduct'));
    }

    public function cart()
    {
        $categoriesLimit = Category::where('parent_id', 0)->take(5)->get();
        $productsRecommend = Product::latest('views_count', 'desc')->take(12)->get();
        return view('client.product.cart.cart', compact('categoriesLimit', 'productsRecommend'));
    }

    public function addToCart($id)
    {
        $product = Product::findOrFail($id);

        $productQty = Product::select('products.*')->where('id', '=', $id)->get();

        foreach($productQty as $productItem){
            if($productItem->quantity > 0){
                $cart = session()->get('cart', []);

                if (isset($cart[$id])) {
                    $cart[$id]['quantity']++;
                } else {
                    $cart[$id] = [
                        "name" => $product->name,
                        "quantity" => 1,
                        "price" => $product->price,
                        "image" => $product->feature_image_path
                    ];
                }
        
                session()->put('cart', $cart);
                return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng thành công!');
            } else{
                return redirect()->back()->with('danger', 'Sản phẩm đã hết hàng!');
            }
        }

        
    }

    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Giỏ hàng đã được cập nhật thành công');
        }
    }

    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Sản phẩm đã được xóa khỏi giỏ hàng thành công');
        }
    }

    //Cart
    // public function addCart(Request $request ,$id)
    // {
    //     $product = Product::where('id', $id)->first();
    //     if ($product != null) {
    //         $oldCart = Session('Cart') ? Session('Cart') : null;
    //         $newCart = new Cart($oldCart);
    //         $newCart->AddCart($product, $id);

    //         $request->session()->put('Cart', $newCart);
    //     }
    //     return view('client.product.cart.cart-item');
    // }

    // public function DeleteItemCart(Request $request ,$id)
    // {
    //     $oldCart = Session('Cart') ? Session('Cart') : null;
    //     $newCart = new Cart($oldCart);
    //     $newCart->DeleteItemCart($id);
    //     if(Count($newCart->products) > 0){
    //         $request->Session()->put('Cart', $newCart);
    //     }
    //     else{
    //         $request->Sesison()->forget('Cart');
    //     }

    //     return view('client.product.cart.cart-item');
    // }

    // public function ViewListCart(){
    //     $categoriesLimit = Category::where('parent_id', 0)->take(5)->get();
    //     return view('client.product.cart.list-cart', compact('categoriesLimit'));
    // }

    // public function DeleteListItemCart(Request $request ,$id)
    // {
    //     $oldCart = Session('Cart') ? Session('Cart') : null;
    //     $newCart = new Cart($oldCart);
    //     $newCart->DeleteItemCart($id);
    //     if(Count($newCart->products) > 0){
    //         $request->Session()->put('Cart', $newCart);
    //     }
    //     else{
    //         $request->Sesison()->forget('Cart');
    //     }

    //     return view('client.product.cart.list-cart');
    // }

    // public function SaveListItemCart(Request $request ,$id, $quanty)
    // {
    //     $oldCart = Session('Cart') ? Session('Cart') : null;
    //     $newCart = new Cart($oldCart);
    //     $newCart->UpdateItemCart($id, $quanty);

    //     $request->Session()->put('Cart', $newCart);

    //     return view('client.product.cart.list-cart');
    // }

    // public function SaveAllListItemCart(Request $request){

    //     foreach($request->data as $item){
    //         $oldCart = Session('Cart') ? Session('Cart') : null;
    //         $newCart = new Cart($oldCart);
    //         $newCart->UpdateItemCart($item["key"], $item["value"]);
    //         $request->Session()->put('Cart', $newCart);
    //     }

    // }

    // public function add_cart_ajax(Request $request)
    // {
    //     $data = $request->all();
    //     $session_id = substr(md5(microtime()), rand(0, 26), 5);
    //     $cart = $request->session()->get('cart');
    //     if ($cart == true) {
    //         $is_avaiable = 0;
    //         foreach ($cart as $key => $val) {
    //             if ($val['product_id'] == $data['cart_product_id']) {
    //                 $is_avaiable++;
    //             }
    //         }
    //         if ($is_avaiable = 0) {
    //             $cart[] = array(
    //                 'session_id' => $session_id,
    //                 'product_name' => $data['cart_product_name'],
    //                 'product_id' => $data['cart_product_id'],
    //                 'product_feature_image_path' => $data['cart_product_feature_image_path'],
    //                 'product_qty' => $data['cart_product_qty'],
    //                 'product_price' => $data['cart_product_price']
    //             );
    //             $request->session()->put('cart', $cart);
    //         }
    //     } else {
    //         $cart[] = array(
    //             'session_id' => $session_id,
    //             'product_name' => $data['cart_product_name'],
    //             'product_id' => $data['cart_product_id'],
    //             'product_feature_image_path' => $data['cart_product_feature_image_path'],
    //             'product_qty' => $data['cart_product_qty'],
    //             'product_price' => $data['cart_product_price']
    //         );
    //         $request->session()->put('cart', $cart);
    //     }
    //     $request->session()->save();
    // }

    // public function show_cart(Request $request)
    // {
    //     $categoriesLimit = Category::where('parent_id', 0)->take(5)->get();
    //     return view('client.product.cart.show-cart', compact('categoriesLimit'));
    // }


}
