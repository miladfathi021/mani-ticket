<?php

use App\Http\Controllers\V1\User\SeatController;

Route::group([], function() {
    Route::get('/seats/{event_hall_id}/{section_id}', [SeatController::class, 'show'])
        ->name('seats.show');
    Route::put('/seats/{event_hall_id}/status', [SeatController::class, 'changeStatus'])
        ->name('seats.show');
});
