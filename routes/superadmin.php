<?php

use App\Http\Controllers\SuperAdmin\DashboardController;
use App\Http\Controllers\SuperAdmin\ClientController;
use App\Http\Controllers\Superadmin\CompanyController;
use App\Http\Controllers\Superadmin\UserController;
use App\Http\Controllers\General\ActivityLogController;
use App\Http\Controllers\General\BatchSetupController;
use App\Http\Controllers\General\EmployeeFeedbackSetupController;
use App\Http\Controllers\General\KRAController;
use App\Http\Controllers\General\KRASetupController;
use App\Http\Controllers\General\SupervisorFeedbackSetupController;
use App\Http\Controllers\SuperAdmin\EmployeeController;
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

        Route::name('employee-feedback.')->prefix('employee-feedback')->group(function (){
            Route::controller(EmployeeFeedbackSetupController::class)->group(function (){
                Route::name('index')->get('/', 'index');
                Route::name('add')->get('/add', 'add');
                Route::name('store')->post('/store', 'store');
                Route::name('view')->get('/view/{employeeFeedback}', 'view');
                Route::name('store-question')->post('/store-question', 'storeQuestion');
                Route::name('update-question')->post('/update-question/{employeeFeedbackQuestion}', 'updateQuestion');
                Route::name('edit')->get('/edit/{employeeFeedback}', 'edit');
                Route::name('update')->post('/update/{employeeFeedback}', 'update');
            });
        });

        Route::name('supervisor-feedback.')->prefix('supervisor-feedback')->group(function (){
            Route::controller(SupervisorFeedbackSetupController::class)->group(function (){
                Route::name('index')->get('/', 'index');
                Route::name('add')->get('/add', 'add');
                Route::name('store')->post('/store', 'store');
                Route::name('view')->get('/view/{supervisorFeedback}', 'view');
                Route::name('store-question')->post('/store-question', 'storeQuestion');
                Route::name('update-question')->post('/update-question/{supervisorFeedbackQuestion}', 'updateQuestion');
                Route::name('edit')->get('/edit/{supervisorFeedback}', 'edit');
                Route::name('update')->post('/update/{supervisorFeedback}', 'update');
            });
        });

        Route::name('kra.')->prefix('kra')->group(function (){
            Route::controller(KRASetupController::class)->group(function (){
                Route::name('index')->get('/', 'index');
                Route::name('add')->get('/add', 'add');
                Route::name('store')->post('/store', 'store');
                Route::name('view')->get('/view/{kra}', 'view');
                Route::name('edit')->get('/edit/{kra}', 'edit');
                Route::name('update')->post('/update/{kra}', 'update');
            });
        });
    });

    //Activity Log
    Route::name('activity-log.')->prefix('activity-log')->group(function (){
        Route::controller(ActivityLogController::class)->group(function (){
            Route::name('index')->get('/', 'index');
        });
    });
});




