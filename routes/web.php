<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});
Route::get('/setcache', 'HomeController@setCache');
Route::get('/getcache', 'HomeController@getCache');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::group([
    'namespace' => 'Backend',
    'prefix' => 'admin',
    'middleware' => 'auth'
], function (){
    Route::get('dashboard', 'DashboardController@index')->name('backdend.dashboard');
    //Quản lý sản phẩm
    Route::group(['prefix'=>'products'], function (){
        Route::post('/getdata', 'ProductController@getData')->name('backend.products.getdata');
        Route::post('/get-product-deleted', 'ProductController@getDeleted')->name('backend.products.getproductdeleted');
        Route::get('/', 'ProductController@index')->name('backend.products.index');
        Route::get('/list-deleted', 'ProductController@listDeleted')->name('backend.products.listdeleted');
        Route::get('/create', 'ProductController@create')->name('backend.products.create');
        Route::post('/store', 'ProductController@store')->name('backend.products.store');
        Route::get('/{product_id}','ProductController@show')->name('backend.products.show');
        Route::get('/{id}/edit','ProductController@edit')->name('backend.products.edit');
        Route::post('/{id}','ProductController@update')->name('backend.products.update');
        Route::delete('/{id}','ProductController@destroy')->name('backend.products.destroy');
        Route::put('/{id}','ProductController@softDelete')->name('backend.products.softDelete');
    });
    //Quản lý người dùng
    Route::group(['prefix' => 'users'], function(){
        Route::get('/', 'UserController@index')->name('backend.user.index');
        Route::get('/create', 'UserController@create')->name('backend.user.create');
        Route::get('/{user_id}','UserController@show')->name('backend.user.show');
    });
    //Quản lý danh mục
    Route::group(['prefix' => 'categories'], function (){
        Route::post('/getdata', 'CategoryController@getData')->name('backend.category.getdata');
        Route::get('/', 'CategoryController@index')->name('backend.category.index');
        Route::get('/create','CategoryController@create')->name('backend.category.create');
        Route::get('/{category_id}','CategoryController@show')->name('backend.category.show');
        Route::post('/store', 'CategoryController@store')->name('backend.category.store');
        Route::get('{id}/edit','CategoryController@edit')->name('backend.category.edit');
        Route::post('/{id}','CategoryController@update')->name('backend.category.update');
        Route::put('/{id}','CategoryController@destroy')->name('backend.category.delete');
    });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
