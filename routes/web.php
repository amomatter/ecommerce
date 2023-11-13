<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web Routes for your application. These
| Routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/',[HomeController::class,'index']);

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

    Route::get('/redirect',[HomeController::class,'redirect']);

    Route::get('/add/category',[AdminController::class,'category']);

    Route::post('store/category',[AdminController::class,'Add_category']);

    Route::get('edit/category/{id}',[AdminController::class,'edit_category']);

    Route::post('update/category/{id}',[AdminController::class,'update_category']);

    Route::get('delete/category/{id}',[AdminController::class,'delete_category']);

    Route::get('view/product',[AdminController::class,'view_product']);

    Route::post('add/product',[AdminController::class,'add_product']);

    Route::get('show/product',[AdminController::class,'show_product']);

    Route::get('edit/product/{id}',[AdminController::class,'edit_product']);

    Route::post('update/product/{id}',[AdminController::class,'update_product']);

    Route::get('delete/product/{id}',[AdminController::class,'delete_product']);

    Route::get('product/details/{id}',[HomeController::class,'product_details']);

    Route::post('add_cart/{id}',[HomeController::class,'add_cart']);

    Route::get('show/cart',[HomeController::class,'show_cart']);

    Route::get('delete/cart/{id}',[HomeController::class,'delete_cart']);

    Route::get('pay/Delivery',[HomeController::class,'pay_Delivery']);

    Route::get('stripe/{total}',[HomeController::class,'stripe']);

    Route::post('stripe/{total}', [HomeController::class,'stripePost'])->name('stripe.post');


    Route::get('order', [AdminController::class,'order']);


    Route::get('delivered/{id}', [AdminController::class,'delivered']);

    Route::get('print/pdf/{id}', [AdminController::class,'print_pdf']);

    Route::get('search', [AdminController::class,'search']);

    Route::get('product_search', [HomeController::class,'product_search']);







