<?php

use App\Http\Controllers\SuperAdmin\DashboardController;
use App\Http\Controllers\SuperAdmin\ClientController;
use App\Http\Controllers\Superadmin\CompanyController;
use App\Http\Controllers\Superadmin\UserController;
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

Route::middleware(['auth','superadmin'])->prefix('superadmin')->name('superadmin.')->group(function(){
     
    //dashboard
     Route::controller(DashboardController::class)->group(function (){
        Route::name('index')->get('/','index');
        Route::name('show')->get('/show','index');
    });

    Route::name('client.')->prefix('client')->group(function (){
        Route::controller(ClientController::class)->group(function (){
            Route::name('index')->get('/', 'index');
            Route::name('add')->get('/add', 'add');
            Route::name('store')->post('/store', 'store');
            Route::name('view')->get('/view/{client}','view');
            Route::name('edit')->get('/edit/{client}', 'edit');
            Route::name('update')->post('/update/{client}', 'update');
        });
    });

    Route::name('company.')->prefix('company')->group(function (){
        Route::controller(CompanyController::class)->group(function (){
            Route::name('index')->get('/', 'index');
            Route::name('add')->get('/add', 'add');
            Route::name('store')->post('/store', 'store');
            Route::name('view')->get('/view/{company}', 'view');
            Route::name('edit')->get('/edit/{company}', 'edit');
            Route::name('update')->post('update/{company}', 'update');
        });
    });

    Route::name('user.')->prefix('user')->group(function (){
        Route::controller(UserController::class)->group(function (){
            Route::name('index')->get('/', 'index');  
            Route::name('store')->post('/store', 'store');
            Route::name('update')->post('/update/{user}', 'update'); 
            Route::name('updatepassword')->post('/updatepassword/{user}', 'updatepassword');
            Route::name('resend')->post('/resend/{user}', 'resend');
        });
    });

});




