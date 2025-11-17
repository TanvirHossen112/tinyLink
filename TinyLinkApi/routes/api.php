<?php

use App\Http\Controllers\Api\V1\AuthenticationController;
use App\Http\Controllers\Api\V1\RegistrationController;
use App\Http\Controllers\Api\V1\TinyLinkController;

Route::group(['prefix' => 'v1'], function () {

    Route::group(['prefix' => 'auth', 'name' => 'auth.'], function () {
        Route::post('/login', [AuthenticationController::class, 'login'])->name('login');
        Route::post('/register', [RegistrationController::class, 'store'])->name('register');
        Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');
    });

    Route::group([], function () {
        Route::apiResource('/tiny-links', TinyLinkController::class);
    });

});
