<?php

use App\Http\Controllers\V1\Admin\HallController;

Route::post('/halls', [HallController::class, 'store'])
    ->name('admin.halls.store');
Route::get('/halls', [HallController::class, 'index'])
    ->name('admin.halls.index');
Route::get('/halls/{hall}', [HallController::class, 'show'])
    ->name('admin.halls.show');
Route::patch('/halls/{hall}', [HallController::class, 'update'])
    ->name('admin.halls.update');
Route::delete('/halls/{hall}', [HallController::class, 'destroy'])
    ->name('admin.halls.destroy');
