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
Route::group(
    ['prefix' => 'password', 'as' => 'password.'], function () {
    Route::get('reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('request');
    Route::post('email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('email');
    Route::get('reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('reset');
    Route::post('reset', 'Auth\ResetPasswordController@reset');
});

// Social login routes ...
Route::group(
    ['prefix' => 'oauth', 'as' => 'oauth.', 'middleware' => ['guest', 'throttle']], function () {
    Route::get('{provider}', 'Auth\SocialiteController@redirectToProvider')->name('login')->where('provider', 'google');
    Route::get('{provider}/callback', 'Auth\SocialiteController@handleProviderCallback')->where('provider', 'google');;
});


// User account routes ...
Route::group(['middleware' => ['auth'], 'prefix' => 'account', 'as' => 'account.'], function () {

    Route::get('/', 'Account\ProfileController@edit')->name('edit');
    Route::post('update', 'Account\ProfileController@update')->name('update');

    Route::group(['prefix' => 'password', 'as' => 'password.'], function () {
        Route::get('/', 'Account\PasswordController@edit')->name('edit');
        Route::post('update', 'Account\PasswordController@update')->name('update');
    });

    Route::group(['prefix' => 'actions', 'as' => 'actions.'], function () {
        Route::post('logout-other-devices', 'Account\ActionController@logoutOtherDevices')->name('logout-other-devices');
        Route::post('password-reset-email', 'Account\ActionController@sendPasswordResetEmail')->name('password-reset-email');
    });

});

// Shop routes ..., works only on today's order
Route::group(['middleware' => ['auth', 'role:customer'], 'prefix' => 'shop', 'as' => 'shop.'], function () {
    Route::get('/', 'ShopController@index')->name('index');
    Route::post('store', 'ShopController@store')->name('store');
    Route::post('cancel', 'ShopController@cancel')->name('cancel');
    Route::post('restore', 'ShopController@restore')->name('restore');
});

// My orders routes ...
Route::resource(
    'orders', 'OrderController', ['only' => [
        'index', 'show',
    ]]
)->middleware(['auth', 'role:customer']);
