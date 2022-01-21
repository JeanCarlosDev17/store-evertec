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
})->middleware(['auth','verified','userStateActive','nocache'])->name('dashboard');

//Route::resource('admin/example','\App\Http\Controllers\UserController');
Route::middleware(['auth', 'verified','role:admin','nocache'])->group(function () {
    Route::get('/admin',[UserController::class,'index'])->name('admin.index');
    Route::get('admin/users',[UserController::class,'index'])->name('users.index');
    Route::post('admin/users',[UserController::class,'store'])->name('users.store');
    Route::get('admin/users/create',[UserController::class,'create'])->name('users.create');
    Route::get('admin/users/{user}',[UserController::class,'show'])->name('users.show');
    Route::put('admin/users/{user}',[UserController::class,'update'])->name('users.update');
    Route::patch('admin/users/{user}',[UserController::class,'update'])->name('users.patch');
    Route::delete('admin/users/{user}',[UserController::class,'destroy'])->name('users.destroy');
    Route::get('admin/users/{user}/edit',[UserController::class,'edit'])->name('users.edit');
    Route::put('admin/users/{user}/state',[UserController::class,'state'])->name('users.state');

});




require __DIR__.'/auth.php';