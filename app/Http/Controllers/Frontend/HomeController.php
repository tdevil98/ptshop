<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    public function __construct()
    {

    }
    public function index(){
        $categories = Category::get();
        $products = Product::orderBy('created_at', 'desc')->get();
        return view('index', compact('categories', 'products'));
    }
    public function addToCart($id){
        if (Auth::check()){
            $product = Product::find($id);
            if (isset($product->sale_price)){
                Cart::add($product->id, $product->name, 1, $product->sale_price, 1, ['slug' => $product->slug, 'image' => $product->image->first()->image]);
            }else{
                Cart::add($product->id, $product->name, 1, $product->origin_price, 1, ['slug' => $product->slug, 'image' => $product->image->first()->image]);
            }
            return response()->json(['message' => true]);
        }else{
            return response()->json(['message' => false]);
        }
    }
    public function getCart(){
        if (!Auth::user()){
            return redirect()->route('login');
        }else{
            return view('frontend.cart');
        }
    }
    public function updateCart(Request $request){
        $quantity = $request->quantity;
        $i = 0;
        foreach (Cart::content() as $product){
            Cart::update($product->rowId, $quantity[$i]);
            $i++;
        }
        return response()->json(['message'=> true]);
    }
    public function productDetail($slug){
        $product = Product::where('slug', $slug)->first();
        return view('frontend.product_details', compact('product'));
    }
    public function getProductByCate($slug){
        $cate = Category::where('slug', $slug)->first();
        $products = Product::where('category_id', $cate->id)->get();
        return view('frontend.browe_product', compact('products', 'cate'));
    }
    public function getBill(){
        $user = Auth::user();
        $products_cart = Cart::content();
        $products = [];
        foreach($products_cart as $key => $value){
            $product = Product::find($value->id);
            array_push($products, $product);
        }
        return view('frontend.checkout', compact('products', 'user'));
    }
    public function getSubtotal(){
        $subtotal = Cart::subtotal();
        return response()->json(['subtotal' => $subtotal]);
    }
}
