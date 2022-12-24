<?php

use App\Http\Controllers\V1\User\HallController;

Route::group([], function() {
    Route::get('/halls/{event_hall_id}', [HallController::class, 'show'])
        ->name('halls.show');
});
