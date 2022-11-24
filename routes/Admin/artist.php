<?php

use App\Http\Controllers\V1\Admin\ArtistController;

Route::post('/artists', [ArtistController::class, 'store'])
    ->name('artists.store');
Route::get('/artists', [ArtistController::class, 'index'])
    ->name('artists.index');
Route::get('/artists/{artist}', [ArtistController::class, 'show'])
    ->name('artists.show');
