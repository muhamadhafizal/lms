<?php

use App\Http\Controllers\General\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\General\UserController;

Route::singleton('profile', ProfileController::class);
Route::put('password', [ProfileController::class, 'updatePassword'])->name('password.update');

Route::get('get-users/{companyId}', [UserController::class, 'getUsers'])->name('get.users');
