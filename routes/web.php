<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EsewaController;

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




Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('homepage');
Route::get('/shop/{slug?}', [\App\Http\Controllers\ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/tag/{slug?}', [\App\Http\Controllers\ShopController::class, 'tag'])->name('shop.tag');
Route::get('/product/{product:slug}', [\App\Http\Controllers\ProductController::class, 'show'])->name('product.show');

// react route
Route::get('products/{slug?}', [\App\Http\Controllers\ShopController::class, 'getProducts']);
Route::get('products', [\App\Http\Controllers\HomeController::class, 'getProducts']);
Route::get('product-detail/{product:slug}', [\App\Http\Controllers\ProductController::class, 'getProductDetail']);
Route::post('carts', [\App\Http\Controllers\CartController::class, 'store']);
Route::get('carts', [\App\Http\Controllers\CartController::class, 'showCart']);



// get user login
Route::get('api/users', [\App\Http\Controllers\UserController::class, 'index']);
// ==========

//esewa payment success and failure
Route::get('/payment-success',[EsewaController::class,'paymentSuccess']);
Route::get('/payment-failure',[EsewaController::class,'paymentFailure']);

//fail page and success page

Route::get('/success-page',[EsewaController::class,'successPage']);
Route::get('/fail-page',[EsewaController::class,'failPage']);



Route::group(['middleware' => 'auth'], function() {
    
    Route::get('/order/checkout', [\App\Http\Controllers\OrderController::class, 'process'])->name('checkout.process');
    Route::resource('/cart', \App\Http\Controllers\CartController::class)->except(['store', 'show']);

   

    Route::group(['middleware' => ['isAdmin'],'prefix' => 'admin', 'as' => 'admin.'], function() {
        Route::get('dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
       
        // categories
        Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
        Route::post('categories/images', [\App\Http\Controllers\Admin\CategoryController::class,'storeImage'])->name('categories.storeImage');
    
        // tags
        Route::resource('tags', \App\Http\Controllers\Admin\TagController::class);

       // Route::get('/orders',[\App\Http\Controllers\OrderController::class,'index'])->name('orderes.index');
    
        // products
        Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
        Route::post('products/images', [\App\Http\Controllers\Admin\ProductController::class,'storeImage'])->name('products.storeImage');
    });
});

Auth::routes();

Route::post('/esewa', [EsewaController::class, 'esewaCheckoutApi'])->name('api.esewa.checkout');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
