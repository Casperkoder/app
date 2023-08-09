<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PropertyController;
use \App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/Start', [HomeController::class,'Start'])->name("home-start");
Route::get('/hakkinda', [HomeController::class,'About'])->name("home-about");
//{
//    return view("home.start");
//});

//Route::get('/hakkinda', function () {
//    return view("home.about");
//});


Route::get('/dashboard', [AdminController::class, 'Dashboard'])->middleware(['auth'])->name('dashboard');

//kategori sayfasının rotası
Route::group(['prefix' => '/categories', 'middleware' => ['auth', 'role:admin']], function () {
    Route::get('/', [CategoryController::class, 'GetCategories'])->name('categories');
    Route::post('/', [CategoryController::class, 'CreateCategory'])->name('create-category');
    Route::get('/{category_id}', [CategoryController::class, 'GetOneCategory'])->name("get-one-category");
    Route::delete('/{category_id}', [CategoryController::class, 'DeleteCategory'])->name("delete-category");
    Route::put('/{category_id}', [CategoryController::class, 'UpdateCategory'])->name("update-category");
});

////ürün rota
//Route::group(['prefix' => '/products', 'middleware' => ['auth', 'role:admin']], function (){
//    Route::get('/', [ProductController::class,'GetProducts'])->name('products');
//    Route::post('/',[ProductController::class,'CreateProduct'])->name('create-product');
//    Route::get('/{product_id}', [ProductController::class, 'GetOneProduct'])->name("get-one-product");
//    Route::delete('/{product_id}', [ProductController::class, 'DeleteProduct'])->name("delete-product");
//    Route::put('/{product_id}', [ProductController::class, 'UpdateProduct'])->name("update-product");
//});


//özellikler tablosu
Route::group(['prefix' => '/properties'], function () {
    Route::post('/', [PropertyController::class, "CreateProperty"])->name("create-property");
    Route::put('/{property_id}', [PropertyController::class, "UpdateProperty"])->name("update-property");
    Route::delete('/{property_id}', [PropertyController::class, "RemoveProperty"])->name("remove-property");
});

//PROFİL KISMININ ROTASI
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
});

//KULLANICILAR ROTASI
Route::group(['prefix' => '/users', 'middleware' => ['auth', 'role:admin']], function () {
    // tum kullanıcıları listeler
    Route::get('/', [UserController::class, 'GetAllUsers'])->name('get-all-users');

    // bir kullanıcı ekler
    Route::post('/', [UserController::class, 'CreateUser'])->name('create-user');

    // bir kullanıcını bilgilerini gösterir
    Route::get('/{user_id}', [UserController::class, 'GetOneUser'])->name('get-one-user');

    // bir kullanıcını uyeliğini siler
    Route::delete('/{user_id}', [UserController::class, 'DeleteUser'])->name('delete-user');

    // bir kullancıyı günceller
    Route::put('/{user_id}', [UserController::class, 'UpdateUser'])->name('update-user');

});

Route::get('user/ara/', [UserController::class, 'SearchUser'])->name('search-user');


require __DIR__ . '/product.php';
require __DIR__ . '/auth.php';
