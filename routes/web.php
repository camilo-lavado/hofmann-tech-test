<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;

Route::get('/', [UserController::class, 'index']);
Route::post('/send', [UserController::class, 'send'])->name('send-user');
