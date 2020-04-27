<?php

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

Route::group([
    'prefix' => 'v1',
], function () {
    Route::prefix('/user')->group(function () {
        Route::post('/register', 'Auth\AuthController@register');
        Route::post('/password-login', 'Auth\AuthController@passwordLogin');
        Route::get('/{id}', 'Auth\AuthController@show');
    });

});
