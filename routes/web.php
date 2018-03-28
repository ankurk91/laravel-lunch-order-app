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

Route::view('/', 'home');

Route::group(
    ['prefix' => 'oauth', 'as' => 'oauth.', 'middleware' => ['guest', 'throttle']], function () {
    Route::get('/{provider}', 'Auth\SocialiteController@redirectToProvider')->name('login')->where('provider', 'google');
    Route::get('/{provider}/callback', 'Auth\SocialiteController@handleProviderCallback')->where('provider', 'google');;
});
