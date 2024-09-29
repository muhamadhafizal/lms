<?php

use App\Http\Controllers\HRadmin\DashboardController;
use App\Http\Controllers\General\ActivityLogController;
use App\Http\Controllers\General\BatchSetupController;
use App\Http\Controllers\HRAdmin\EmployeeController;
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

    Route::name('employee.')->prefix('employee')->group(function (){
        Route::controller(EmployeeController::class)->group(function (){
            Route::name('index')->get('/', 'index');
            Route::name('add')->get('/add', 'add');
            Route::name('store')->post('/store', 'store');
            Route::name('view')->get('/view/{employee}', 'view');
            Route::name('edit')->get('/edit/{employee}', 'edit');
            Route::name('update')->post('/update/{employee}', 'update');
            Route::name('resend')->post('/resend/{employee}', 'resend');
        });
    });

    Route::name('setups.')->prefix('setups')->group(function (){
        Route::name('batch.')->prefix('batch')->group(function (){
            Route::controller(BatchSetupController::class)->group(function (){
                Route::name('index')->get('/', 'index');
                Route::name('add')->get('/add', 'add');
                Route::name('store')->post('/store', 'store');
                Route::name('view')->get('/view/{batch}', 'view');
                Route::name('edit')->get('/edit/{batch}', 'edit');
                Route::name('update')->post('/update/{batch}', 'update');
            });
        });
    });

    Route::name('activity-log.')->prefix('activity-log')->group(function (){
        Route::controller(ActivityLogController::class)->group(function (){
            Route::name('index')->get('/', 'index');
        });
    });
});



