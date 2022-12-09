<?php

use App\Http\Controllers\V1\Admin\EventController;

Route::post('/events', [EventController::class, 'store'])
    ->name('admin.events.store');
Route::get('/events', [EventController::class, 'index'])
    ->name('admin.events.index');
Route::get('/events/{event}', [EventController::class, 'show'])
    ->name('admin.events.show');
