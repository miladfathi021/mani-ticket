<?php

use App\Http\Controllers\V1\Auth\LoginController;

Route::post('login', [LoginController::class, 'store'])
    ->name('login');
