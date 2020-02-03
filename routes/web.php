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
Route::middleware('auth')->group(function (){
    Route::get('/addtocart/{id}', 'Frontend\HomeController@addToCart')->name('frontend.addtocart');
    Route::get('/cart', 'Frontend\HomeController@getCart')->name('frontend.cart');
    Route::get('/checkout', 'Frontend\HomeController@getBill')->name('frontend.get-bill');
    Route::post('/update-cart', 'FrontEnd\HomeController@updateCart');
    Route::post('/remove-cart', 'FrontEnd\HomeController@removeCart');
    Route::post('/submit-bill', 'FrontEnd\HomeController@submitBill');
    Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
});
Route::get('/', 'Frontend\HomeController@index');
Route::get('/product/{slug}', 'Frontend\HomeController@productDetail')->name('frontend.product');
Route::get('/category/{slug}', 'Frontend\HomeController@getProductByCate')->name('frontend.category');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

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
        Route::post('/{id}/update','ProductController@update')->name('backend.products.update');
        Route::delete('/{id}/destroy','ProductController@destroy')->name('backend.products.destroy');
        Route::put('/{id}/softdelete','ProductController@softDelete')->name('backend.products.softDelete');
        Route::put('/{id}/restore','ProductController@restore')->name('backend.products.restore');
        Route::group(['prefix' => '/{id}'], function (){
            Route::get('/quantity', 'ProductController@productQuantity')->name('backend.products.quantity');
            Route::post('/getdataproduct', 'ProductController@getProductQuantity')->name('backend.products.getquantity');
            Route::post('/create', 'ProductController@storeQuantity')->name('backend.product.store.quantity');
            Route::get('/edit-quantity','ProductController@editQuantity')->name('backend.product.edit.quantity');
            Route::post('/update-quantity', 'ProductController@updateQuantity')->name('backend.product.update.quantity');
            Route::delete('/destroy-quantity', 'ProductController@destroyQuantity')->name('backend.product.destroy.quantity');
        });
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
