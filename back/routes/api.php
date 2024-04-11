<?php

use App\Http\Controllers\V1\AuthController;
use App\Http\Controllers\V1\RegisterController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', 'middleware' => 'api'], function (){

    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [RegisterController::class, 'register'])->name('register');

});
