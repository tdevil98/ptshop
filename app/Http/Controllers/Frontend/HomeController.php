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
            Cart::add($product->id, $product->name, 1, $product->sale_price, 1);
            return response()->json(['message' => true]);
        }else{
            return response()->json(['message' => false]);
        }
    }
    public function getCart(){
        $products_cart = Cart::content();
        $products = [];
        foreach($products_cart as $key => $value){
            $product = Product::find($value->id);
            array_push($products, $product);
        }
        return view('frontend.cart', compact('products'));
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
}
