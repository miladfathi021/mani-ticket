<?php

use App\Http\Controllers\V1\Admin\EventController;

Route::post('/events', [EventController::class, 'store'])
    ->name('events.store');
Route::get('/events', [EventController::class, 'index'])
    ->name('events.index');
Route::get('/events/{event}', [EventController::class, 'show'])
    ->name('events.show');
