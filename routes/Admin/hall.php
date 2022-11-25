<?php

use App\Http\Controllers\V1\Admin\HallController;

Route::post('/halls', [HallController::class, 'store'])
    ->name('halls.store');
Route::get('/halls', [HallController::class, 'index'])
    ->name('halls.index');
Route::get('/halls/{hall}', [HallController::class, 'show'])
    ->name('halls.show');
Route::patch('/halls/{hall}', [HallController::class, 'update'])
    ->name('halls.update');
Route::delete('/halls/{hall}', [HallController::class, 'destroy'])
    ->name('halls.destroy');
