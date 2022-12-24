<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('auth:api')->prefix('/v1/admin')->group(function () {
    require('Admin/complex.php');
    require('Admin/hall.php');
    require('Admin/section.php');
    require('Admin/event.php');
    require('Admin/artist.php');
});


Route::group(['prefix' => '/v1'], function () {
    require('Auth/auth.php');
    require('User/event.php');
    require('User/hall.php');
    require('User/seat.php');
});
