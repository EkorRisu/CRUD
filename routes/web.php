<?php

use App\Http\Controllers\PerpusController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;  // Tambahkan ini


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

// Public routes (tidak memerlukan autentikasi)
Route::get('/',[PerpusController::class,'index'])->name('perpus.index');
Route::get('login', [CustomAuthController:: class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController:: class, 'customLogin'])->name('login.custom');
Route::get('registration', [CustomAuthController:: class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController:: class, 'customRegistration'])->name('register.custom');

// Route yang memerlukan autentikasi
Route::middleware('auth')->group(function () {
    Route::get('/create',[PerpusController::class,'create'])->name('perpus.create');
    Route::post('/',[PerpusController::class,'store'])->name('perpus.store');
    Route::get('{perpus}',[PerpusController::class,'show'])->name(  'perpus.show');
    Route::get('{id}/edit',[PerpusController::class,'edit'])->name('perpus.edit');
    Route::post('{id}',[PerpusController::class,'update'])->name('perpus.update');
    Route::delete('{id}',[PerpusController::class,'delete'])->name('perpus.destroy');

    // Dashboard route, hanya bisa diakses jika sudah login
    Route::get('dashboard', [PerpusController::class,'dashboard'])->name('dashboard');

    // Signout
    Route::get('logout', [CustomAuthController::class, 'logout'])->name('signout');
});
