<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\UserController;
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
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth','verified'])->name('dashboard');

//Route::resource('admin/example','\App\Http\Controllers\UserController');
Route::get('/admin',[UserController::class,'index'])->middleware(['auth','verified'])->name('admin.index');
Route::get('admin/users',[UserController::class,'index'])->name('users.index')->middleware(['auth','verified']);
Route::post('admin/users',[UserController::class,'store'])->name('users.store')->middleware(['auth','verified']);
Route::get('admin/users/create',[UserController::class,'create'])->name('users.create')->middleware(['auth','verified']);
Route::get('admin/users/{user}',[UserController::class,'show'])->name('users.show')->middleware(['auth','verified']);
Route::put('admin/users/{user}',[UserController::class,'update'])->name('users.update')->middleware(['auth','verified']);
Route::patch('admin/users/{user}',[UserController::class,'update'])->name('users.patch')->middleware(['auth','verified']);
Route::delete('admin/users/{user}',[UserController::class,'destroy'])->name('users.destroy')->middleware(['auth','verified']);
Route::get('admin/users/{user}/edit',[UserController::class,'edit'])->name('users.edit')->middleware(['auth','verified']);
Route::put('admin/users/{user}/state',[UserController::class,'state'])->name('users.state')->middleware(['auth','verified']);



require __DIR__.'/auth.php';
