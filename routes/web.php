<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ProductController;

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

Route::get('/', function () {
    return view('login');
});

// user registration
Route::get('/register', [UserController::class, 'create']);
Route::post('/registration', [UserController::class, 'store']);

// Login and logout
Route::get('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);

// customer
Route::get('/dashboard', [UserController::class, 'index']);
Route::get('/products-users', [UserController::class, 'show']);

Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/remove-from-cart', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart');



// admin
Route::get('/admin-dashboard', [AdminController::class, 'home']);
Route::get('/products-list-admin', [AdminController::class, 'index']);

Route::get('/add-product',[AdminController::class, 'createProduct']);
Route::post('/product-adding',[AdminController::class, 'storeProduct']);
Route::get('/product-edit/{id}',[AdminController::class, 'editProduct']);
Route::put('/product-editing/{id}',[AdminController::class, 'updateProduct']);
Route::get('/product-delete/{id}',[AdminController::class, 'destroyProduct']);
Route::get('/stock-edit/{id}',[ProductController::class, 'editStock']);
Route::put('/stock-editing/{id}',[ProductController::class, 'updateStock']);

Route::get('/add-vendors', [AdminController::class, 'createVendor']);
Route::post('/vendors-adding', [AdminController::class, 'storeVendor']);
Route::get('/admin-vendors-list',[AdminController::class, 'listVendors']);
Route::get('/edit-vendor/{id}',[AdminController::class, 'editVendor']);
Route::put('/vendor-editing/{id}',[AdminController::class, 'updateVendor']);
Route::get('/delete-vendor/{id}',[AdminController::class, 'destroyVendor']);

// vendor
Route::get('/vendor-dashboard', [VendorController::class, 'index']);
Route::get('/vendor-product-list', [VendorController::class, 'showProducts']);
Route::get('/add-product-vendor',[VendorController::class, 'createProduct']);
Route::post('/product-adding-vendor',[VendorController::class, 'storeProduct']);

Route::get('/product-edit-vendor/{id}',[VendorController::class, 'editProduct']);
Route::put('/product-editing-vendor/{id}',[VendorController::class, 'updateProduct']);
Route::get('/product-delete-vendor/{id}',[VendorController::class, 'destroyProduct']);

Route::get('/stock-edit-vendor/{id}',[VendorController::class, 'editStock']);
Route::put('/stock-editing-vendor/{id}',[VendorController::class, 'updateStock']);
