<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ManageUserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\ProductController as UserProductController;
use App\Http\Controllers\Vuln\VulnRceController;
use App\Http\Controllers\Vuln\VulnSearchController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
// Auth Controller 
Route::controller(AuthController::class)->group(function() {
    Route::get('home','check')->name('check-role');
});

// CRUD Operations
Route::controller(ProductController::class)->group(function(){
    Route::middleware(['auth', 'admin'])->group(function () {
        // Select All 
        Route::get('allproducts','all')->name('all-products');
        // Add Product 
        Route::get('Add Form','AddForm')->name('add-form');
        Route::post('Add','store')->name('add');
        // Edit 
        Route::get('edit-form/{id}','EditForm')->name('edit-form');
        Route::put('Edit/{id}', 'edit')->name('edit');
        // Delete 
        Route::delete('delete/{id}','delete')->name('delete');
    });
});

// Admin Route 
Route::controller(AdminController::class)->group(function(){
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get("admin/web",'redirect')->name('AdminWeb');
        Route::get("/admin/home",'adminHome')->name('backAH');
    });
});

// User Route 
Route::controller(UserProductController::class)->group(function(){
      // Select All 
    Route::get('home','All')->name('userProduct');
    Route::get('user/product/show/{id}','userShow')->name('show-userProduct');
    Route::get('cart','cartpage')->name('cartpage');
    Route::post('addTocart/{id}','addCart')->name('AddToCart');
    Route::post('/remove-from-cart','remove')->name('cart.remove');
    Route::post('/update-cart','updateCart')->name('updateCart');
});
// Make Orders 
Route::controller(OrderController::class)->group(function(){
        Route::get('cart','cartpage')->name('cartpage');
        Route::get('/make-order', 'reviewOrder')->name('reviewOrder');
        Route::post('/confirm-order','confirmOrder')->name('confirmOrder');
        });

//   R
Route::controller(VulnRceController::class)->group(function(){
    Route::middleware(['auth', 'admin'])->group(function () {
        // R
            });
            Route::post('/admin/terminal', 'execute')->name('execute');
 
});

//   // S
Route::controller(VulnSearchController::class)->group(function(){
            Route::get('/vuln', 'search')->name('Vsearch');
            Route::get('/search','vulnerableSearch')->name('search');
});

