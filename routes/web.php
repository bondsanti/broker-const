<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\StatusController;
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

Route::get('/', [MainController::class,'index'])->name('main');

Route::get('/users',[UserController::class,'index'])->name('users');
Route::post('/users',[UserController::class,'store'])->name('users.store');

Route::get('/status',[StatusController::class,'index'])->name('status');
