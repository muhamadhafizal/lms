<?php

use App\Http\Controllers\Member\BorrowingController;
use App\Http\Controllers\Member\BookController;
use App\Http\Controllers\Member\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
|
| Here is where you can register auth routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth', 'member'])->prefix('member')->name('member.')->group(function () {

    //dashboard
    Route::controller(DashboardController::class)->group(function () {
        Route::name('index')->get('/', 'index');
        Route::name('show')->get('/show', 'index');
    });

    Route::resource('book', BookController::class);
    Route::name('book.')->prefix('book')->group(function () {
        Route::name('index')->get('/', [BookController::class, 'index']);
    });

    Route::name('borrowing.')->prefix('borrowing')->group(function (){
        Route::controller(BorrowingController::class)->group(function (){
            Route::name('index')->get('/', 'index');
        });
    });

});




