<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => '/products', 'middleware' => ['auth', 'role:admin']], function () {
    //tüm ürünleri listeler
    Route::get('/', [ProductController::class, 'GetAllProducts'])->name('get-all-products');
//bir ürün ekler
    Route::post('/', [ProductController::class, 'CreateProduct'])->name('create-product');

//Bir kullanıcının bilgilerni gösterir
    Route::get('/{product_id}', [ProductController::class, 'GetOneProduct'])->name("get-one-product");
//bir kullanıcının uyeliğini siler
    Route::delete('/{product_id}', [ProductController::class, 'DeleteProduct'])->name("delete-product");
//bir kullanıcının uyeliğini günceller
    Route::put('/{product_id}', [ProductController::class, 'UpdateProduct'])->name("update-product");
});


//açıklama yaz
Route::group(['prefix' => '/product-property', 'middleware' => ['auth', 'role:admin']], function () {
    Route::post('/', [ProductController::class, 'CreateProductProperties'])
        ->name("create-product-properties");
});
