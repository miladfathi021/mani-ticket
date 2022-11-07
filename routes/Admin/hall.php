<?php

use App\Http\Controllers\V1\Admin\HallController;

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('/halls', [HallController::class, 'store'])
        ->name('halls.store');
    Route::get('/halls', [HallController::class, 'index'])
        ->name('halls.index');
    Route::get('/halls/{hall}', [HallController::class, 'show'])
        ->name('halls.show');
});
