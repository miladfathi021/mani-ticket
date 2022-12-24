<?php

use App\Http\Controllers\V1\User\SeatController;

Route::group([], function() {
    Route::get('/seats/{event_hall_id}/{section_id}', [SeatController::class, 'show'])
        ->name('seats.show');
});
