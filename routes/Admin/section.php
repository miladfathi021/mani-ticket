<?php

use App\Http\Controllers\V1\Admin\SectionController;

Route::post('/sections', [SectionController::class, 'store'])
    ->name('sections.store');
Route::get('/sections', [SectionController::class, 'index'])
    ->name('sections.index');
Route::get('/sections/{section}', [SectionController::class, 'show'])
    ->name('sections.show');
Route::patch('/sections/{section}', [SectionController::class, 'update'])
    ->name('sections.update');
