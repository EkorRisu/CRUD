<?php

use App\Http\Controllers\PerpusController;
use Illuminate\Support\Facades\Route;

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
Route::get('/',[PerpusController::class,'index'])->name('perpus.index');
Route::get('/create',[PerpusController::class,'create'])->name('perpus.create');
Route::post('/',[PerpusController::class,'store'])->name('perpus.store');
Route::get('{id}',[PerpusController::class,'show'])->name('perpus.show');
Route::get('{id}/edit',[PerpusController::class,'edit'])->name(name: 'perpus.edit');
Route::post('{id}',[PerpusController::class,'update'])->name('perpus.update');
Route::delete('{id}',[PerpusController::class,'delete'])->name('perpus.destroy');


Route::get('dashboard',[PerpusController::class,'dashboard']);
