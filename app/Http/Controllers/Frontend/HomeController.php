<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Category;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Arr;

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
        $price = [];
        $i = 0;
        foreach (Cart::content() as $product){
            Cart::update($product->rowId, $quantity[$i]);
            $i++;
            array_push($price, number_format($product->total));
        }
        return response()->json(['price'=> $price]);
    }
    public function removeCart(Request $request){
        Cart::remove($request->rowId);
        return response()->json(['error'=> false]);
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
    public function submitBill(){
        if(Cart::count()<0){
            return response()->json(['error'=>true]);
        }else{
            $bill = new Bill([
                'user_id' => Auth::user()->id,
                'total' => str_replace(",", "", Cart::total()),
            ]);
            $bill->save();
            foreach(Cart::content() as $product) {
                BillDetail::create([
                    'bill_id' => $bill->id,
                    'product_id' => $product->id,
                    'quantity' => $product->qty,
                    'product_price' => $product->price,
                    'total' => $product->total
                ]);
            }
            Cart::destroy();
            return response()->json(['error'=>false]);
        }
    }
    public function getSubtotal(){
        $subtotal = Cart::subtotal();
        return response()->json(['subtotal' => $subtotal]);
    }
}
