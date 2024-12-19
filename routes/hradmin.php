<?php

use App\Http\Controllers\HRAdmin\DashboardController;
use App\Http\Controllers\General\ActivityLogController;
use App\Http\Controllers\General\AppraisalFormSetupController;
use App\Http\Controllers\General\BatchSetupController;
use App\Http\Controllers\General\EmployeeFeedbackSetupController;
use App\Http\Controllers\General\KBASetupController;
use App\Http\Controllers\General\KRAController;
use App\Http\Controllers\General\KRASetupController;
use App\Http\Controllers\General\SupervisorFeedbackSetupController;
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

        Route::name('employee-feedback.')->prefix('employee-feedback')->group(function (){
            Route::controller(EmployeeFeedbackSetupController::class)->group(function (){
                Route::name('index')->get('/', 'index');
                Route::name('add')->get('/add', 'add');
                Route::name('store')->post('/store', 'store');
                Route::name('view')->get('/view/{employeeFeedback}', 'view');
                Route::name('edit')->get('/edit/{employeeFeedback}', 'edit');
                Route::name('update')->post('/update/{employeeFeedback}', 'update');
                Route::name('store-question')->post('/store-question', 'storeQuestion');
                Route::name('update-question')->post('/update-question/{employeeFeedbackQuestion}', 'updateQuestion');
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

        Route::name('kba.')->prefix('kba')->group(function (){
            Route::controller(KBASetupController::class)->group(function (){
                Route::name('index')->get('/', 'index');
                Route::name('form-add')->get('/form-add', 'formAdd');
                Route::name('form-store')->post('/form-store', 'formStore');
                Route::name('form-edit')->get('/form-edit/{kbaForm}', 'formEdit');
                Route::name('form-update')->post('/form-update/{kbaForm}', 'formUpdate');
                Route::name('form-view')->get('/form-view/{kbaForm}', 'formView');
                Route::name('set-add')->get('/set-add/{kbaForm}', 'setAdd');
                Route::name('set-store')->post('/set-store/{kbaForm}', 'setStore');
                Route::name('set-edit')->get('/set-edit/{kbaForm}', 'setEdit');
                Route::name('set-update')->post('/set-update/{kbaForm}', 'setUpdate');
                Route::name('view')->get('/view/{kba}', 'view');
                Route::name('edit')->get('/edit/{kba}', 'edit');
                Route::name('update')->post('/update/{kba}', 'update');
                Route::name('set-copy')->get('/set-copy/{kbaForm}', 'setCopy');
                Route::name('set-copy-store')->post('/set-copy-store/{kbaForm}', 'setCopyStore');
            });
        });
    });

    Route::name('appraisals.')->prefix('appraisals')->group(function (){
        Route::name('form-setups.')->prefix('form-setups')->group(function (){
            Route::controller(AppraisalFormSetupController::class)->group(function (){
                Route::name('index')->get('/', 'index');
                Route::name('add')->get('/add', 'add');
                Route::name('store')->post('/store', 'store');
                Route::name('edit')->get('/edit/{appraisalSetup}', 'edit');
                Route::name('update')->post('/update/{appraisalSetup}', 'update');
                Route::name('view')->get('/view/{appraisalSetup}', 'view');
                Route::name('part-store')->post('/add-part/{appraisalSetup}', 'partStore');
            });
        });
    });

    Route::name('activity-log.')->prefix('activity-log')->group(function (){
        Route::controller(ActivityLogController::class)->group(function (){
            Route::name('index')->get('/', 'index');
        });
    });
});



