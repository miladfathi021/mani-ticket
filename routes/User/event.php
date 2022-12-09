<?php

use App\Http\Controllers\V1\User\EventController;

Route::group([], function() {
    Route::get('/events', [EventController::class, 'index'])
        ->name('events.index');
});
