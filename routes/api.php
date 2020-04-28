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
    Route::prefix('/users')->group(function () {
        Route::post('/register', 'Auth\AuthController@register')->name('users.register');
        Route::post('/password-login', 'Auth\AuthController@passwordLogin')->name('users.passwordLogin');
        Route::get('/{id}', 'Auth\AuthController@show')->name('users.show');
        Route::put('/{id}', 'Auth\AuthController@update')->name('users.update');
    });

});
