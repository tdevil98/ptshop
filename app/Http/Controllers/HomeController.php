<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function setCache(){
        $cate = Category::get();
        $put = Cache::add('name', $cate, 1 );
        dd($put);
    }
    public function getCache(){
        $cate = Cache::remember('name', 1, function (){
           return $cate = Category::get();
        });
        dd($cate);
    }
}
