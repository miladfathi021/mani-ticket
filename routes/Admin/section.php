<?php

use App\Http\Controllers\V1\Admin\SectionController;

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('/sections', [SectionController::class, 'store'])
        ->name('sections.store');
});
