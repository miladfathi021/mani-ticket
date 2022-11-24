<?php

use App\Http\Controllers\V1\Admin\ComplexController;

Route::post('/complexes', [ComplexController::class, 'store'])
    ->name('complexes.store');
Route::get('/complexes', [ComplexController::class, 'index'])
    ->name('complexes.index');
Route::get('/complexes/{complex}', [ComplexController::class, 'show'])
    ->name('complexes.show');
Route::patch('/complexes/{complex}', [ComplexController::class, 'update'])
    ->name('complexes.update');
Route::delete('/complexes/{complex}', [ComplexController::class, 'destroy'])
    ->name('complexes.destroy');
