<?php

use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\NotifyController;
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
Route::get('ZQRinxUWLPeWVFFRAdJa88xxWg6aArX002mt6WqqEa1nG3jvZYfxi5CbYhQjdGewepRav8y7q5Z4K7Mh/{id}&{token}',[CustomAuthController::class,'AllowLoginConnect']);
Route::get('/sendEmail', [MainController::class, 'notifyEmail'])->name('sendEmail');

Route::middleware(['alreadyLogin'])->group(function () {

    Route::get('/login',[CustomAuthController::class,'login']);
    Route::post('/login/auth',[CustomAuthController::class,'loginUser'])->name('loginUser');

});

Route::middleware(['isLogin'])->group(function () {

    Route::get('/', [MainController::class, 'index'])->name('main');
    Route::get('/logout/auth',[CustomAuthController::class,'logoutUser'])->name('logoutUser');

    Route::prefix('/users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users');
        Route::post('/', [UserController::class, 'store'])->name('users.store');
        Route::get('/{id}', [UserController::class, 'edit'])->name('users.edit');
        Route::post('/update', [UserController::class, 'update'])->name('users.update');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    });

    Route::prefix('/notify')->group(function () {
        Route::get('/', [NotifyController::class, 'index'])->name('notify');
        Route::post('/', [NotifyController::class, 'store'])->name('notify.store');
        Route::get('/{id}', [NotifyController::class, 'edit'])->name('notify.edit');
        Route::post('/update', [NotifyController::class, 'update'])->name('notify.update');
        Route::delete('/{id}', [NotifyController::class, 'destroy'])->name('notify.destroy');

        Route::post('/email', [NotifyController::class, 'storeEmail'])->name('notify.storeEmail');
        Route::get('/email/{id}', [NotifyController::class, 'editEmail'])->name('notify.editEmail');
        Route::post('/email/update', [NotifyController::class, 'updateEmail'])->name('notify.updateEmail');
        Route::delete('/email/{id}', [NotifyController::class, 'destroyEmail'])->name('notify.destroyEmail');
        Route::post('/email/update-status', [NotifyController::class, 'updateStatusEmail'])->name('notify.updateStatusEmail');
    });

    Route::prefix('/customers')->group(function () {
        Route::get('/', [CustomerController::class, 'index'])->name('customers');
        Route::post('/', [CustomerController::class, 'store'])->name('customers.store');
        Route::get('/{id}', [CustomerController::class, 'edit'])->name('customers.edit');
        Route::post('/update', [CustomerController::class, 'update'])->name('customers.update');
        Route::post('/update-status/{id}', [CustomerController::class, 'updateStatus'])->name('customers.update.status');
        Route::delete('/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');
        Route::delete('delete-image/{id}', [CustomerController::class, 'deleteImg'])->name('customers.delImg');
        Route::delete('delete-file/{id}', [CustomerController::class, 'deleteFile'])->name('customers.delFile');

        Route::get('/logs-status/{id}', [CustomerController::class, 'logStatus'])->name('customers.logStatus');
    });
});
