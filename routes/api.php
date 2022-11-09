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

Route::group(['prefix' => '/v1/admin'], function () {
    require('Admin/complex.php');
    require('Admin/hall.php');
    require('Admin/section.php');
    require('Admin/event.php');
});


Route::group(['prefix' => '/v1'], function () {

});
