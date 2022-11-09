<?php

use App\Http\Controllers\V1\Admin\EventController;

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('/events', [EventController::class, 'store'])
        ->name('events.store');
});
