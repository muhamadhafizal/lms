<?php

use App\Http\Controllers\HRadmin\DashboardController;
use App\Http\Controllers\General\ActivityLogController;
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

Route::prefix('hradmin')->name('hradmin.')->middleware(['auth','hradmin'])->group(function(){
    //dashboard
    Route::controller(DashboardController::class)->group(function (){
        Route::name('index')->get('/','index');
        Route::name('show')->get('/show','index');
    });

    Route::name('activity-log.')->prefix('activity-log')->group(function (){
        Route::controller(ActivityLogController::class)->group(function (){
            Route::name('index')->get('/', 'index');
        });
    });
});



