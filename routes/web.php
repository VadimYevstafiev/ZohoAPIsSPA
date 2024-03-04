<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\DealController;
use App\Http\Controllers\HomeController;
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

Route::controller(HomeController::class)->group(function() {
    Route::get('/', 'startAuthorization')->name('home');
    Route::get('/zohoapis', 'authorization')->name('auth');
});

Route::controller(AccountController::class)->group(function() {
    Route::get('/account/create', 'create')->name('account.create');
    Route::post('/account/store', 'store')->name('account.store');
});

Route::controller(DealController::class)->group(function() {
    Route::get('/deal/create', 'create')->name('deal.create');
    Route::post('/deal/store', 'store')->name('deal.store');
});
