<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductCartController;
use App\Http\Controllers\ProductController;
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

Route::get('/', [ProductController::class, 'allToStore'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'userStateActive', 'nocache'])->name('dashboard');

Route::middleware(['auth', 'verified', 'role:admin', 'nocache'])->group(function () {
    Route::get('/admin', [UserController::class, 'index'])->name('admin.index');
    Route::get('admin/users', [UserController::class, 'index'])->name('users.index');
    Route::post('admin/users', [UserController::class, 'store'])->name('users.store');
    Route::get('admin/users/create', [UserController::class, 'create'])->name('users.create');
    Route::get('admin/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::put('admin/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::patch('admin/users/{user}', [UserController::class, 'update'])->name('users.patch');
    Route::delete('admin/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('admin/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('admin/users/{user}/state', [UserController::class, 'state'])->name('users.state');
});

Route::get('/admin/products/export', [ProductController::class, 'export'])
    ->middleware(['auth', 'verified', 'role:admin'])
    ->name('products.export');

Route::post('/admin/products/import', [ProductController::class, 'import'])
    ->middleware(['auth', 'verified', 'role:admin'])
    ->name('products.import');

Route::get('admin/reports',function(){
    return view('admin.reports');
});

Route::prefix('admin')->middleware(['auth', 'verified', 'role:admin', 'nocache'])->group(function () {
    Route::resource('products', ProductController::class);
    Route::put('product/{user}/state', [ProductController::class, 'state'])->name('products.state');
});




Route::get('/products/{product}/detail', [ProductController::class, 'show'])->name('products.detail');
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
Route::get('admin/products/{product}', [ProductController::class, 'show'])->name('products.show')->middleware(['role:user', 'nocache']);

Route::resource('products.cart', ProductCartController::class);
Route::resource('cart', CartController::class);
Route::resource('orders', OrderController::class)->middleware(['auth', 'verified', 'userStateActive', 'nocache']);
Route::get('orders/return/{order}', [OrderController::class, 'returnPay'])->middleware(['auth', 'verified', 'userStateActive', 'nocache'])->name('orders.return');

require __DIR__ . '/auth.php';
