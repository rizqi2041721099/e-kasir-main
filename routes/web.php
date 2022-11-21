<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::redirect('/', '/login');

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'authenticate');
});

Route::middleware(['auth'])->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('/logout', 'logout')->name('logout');
    });

    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/user', 'index')->name('user');
        Route::get('/user/create', 'create')->name('user.create');
        Route::post('/user/create', 'store');
        Route::get('/user/edit/{id}', 'edit')->name('user.edit');
        Route::post('/user/update', 'update')->name('user.update');
        Route::delete('/user/delete/{id}', 'delete')->name('user.delete');
    });

    Route::controller(ProductCategoryController::class)->group(function () {
        Route::get('/product-category', 'index')->name('product-category');
        Route::get('/product-category/create', 'create')->name('product-category.create');
        Route::post('/product-category/create', 'store');
        Route::get('/product-category/edit/{id}', 'edit')->name('product-category.edit');
        Route::post('/product-category/update', 'update')->name('product-category.update');
        Route::delete('/product-category/delete/{id}', 'delete')->name('product-category.delete');
    });

    Route::controller(ProductController::class)->group(function () {
        Route::get('/product', 'index')->name('product');
        Route::get('/product/create', 'create')->name('product.create');
        Route::post('/product/create', 'store');
        Route::get('/product/edit/{id}', 'edit')->name('product.edit');
        Route::post('/product/update', 'update')->name('product.update');
        Route::delete('/product/delete/{id}', 'delete')->name('product.delete');
    });

    Route::controller(TransactionController::class)->group(function () {
        Route::get('/transaction', 'index')->name('transaction');
        Route::get('/transaction/{id}', 'detail')->name('transaction.detail');
    });

    Route::controller(CashierController::class)->group(function () {
        Route::get('/cashier', 'index')->name('cashier');
        Route::post('/cashier/create', 'store')->name('cashier.create');
        Route::post('/cashier/pay/{id}', 'pay')->name('cashier.pay');
    });
});
