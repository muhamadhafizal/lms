<?php

use App\Http\Controllers\General\ProfileController;
use Illuminate\Support\Facades\Route;

Route::singleton('profile', ProfileController::class);
Route::put('password', [ProfileController::class, 'updatePassword'])->name('password.update');
