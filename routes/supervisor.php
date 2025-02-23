<?php

use App\Http\Controllers\Supervisor\DashboardController;
use App\Http\Controllers\General\ActivityLogController;
use App\Http\Controllers\General\StaffAppraisalController;
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

Route::prefix('supervisor')->name('supervisor.')->middleware(['auth','supervisor'])->group(function(){
    //dashboard
    Route::controller(DashboardController::class)->group(function (){
        Route::name('index')->get('/','index');
        Route::name('show')->get('/show','index');
    });

     //Appraisals
     Route::name('appraisals.')->prefix('appraisals')->group(function (){
        Route::controller(StaffAppraisalController::class)->group(function (){
            Route::name('index')->get('/', 'index');
            Route::name('view')->get('/view/{appraisalSetup}', 'view');
        });
    });

    Route::name('activity-log.')->prefix('activity-log')->group(function (){
        Route::controller(ActivityLogController::class)->group(function (){
            Route::name('index')->get('/', 'index');
        });
    });
});



