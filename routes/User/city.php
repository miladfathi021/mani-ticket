<?php

use App\Http\Controllers\V1\User\CityController;

Route::group([], function() {
    Route::get('/cities', [CityController::class, 'index']);
});
