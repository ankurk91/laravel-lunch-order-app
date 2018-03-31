<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'home')->name('home');

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

// Social login Routes ...
Route::group(
    ['prefix' => 'oauth', 'as' => 'oauth.', 'middleware' => ['guest', 'throttle']], function () {
    Route::get('/{provider}', 'Auth\SocialiteController@redirectToProvider')->name('login')->where('provider', 'google');
    Route::get('/{provider}/callback', 'Auth\SocialiteController@handleProviderCallback')->where('provider', 'google');;
});


// User account routes ...
Route::group(['middleware' => ['auth'], 'prefix' => 'account', 'as' => 'account.'], function () {

    Route::get('/', 'Account\ProfileController@edit')->name('edit');
    Route::post('/edit', 'Account\ProfileController@update')->name('update');

    Route::group(['prefix' => 'password', 'as' => 'password.'], function () {
        Route::get('/', 'Account\PasswordController@edit')->name('edit');
        Route::post('/edit', 'Account\PasswordController@update')->name('update');
    });

});
