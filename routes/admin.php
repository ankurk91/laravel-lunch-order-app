<?php


/*
|---------------------------------------------------------------
| Admin related routes
|---------------------------------------------------------------
|
| Define routes that starts with /admin/ here
| All routes are already protected with 'role:admin' middleware
| Don't prefix your routes with /admin/
|
*/

Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
    Route::patch('/{user}/update-roles', 'UserController@updateRoles')->name('update-roles')->where('user', '[0-9]+');
    Route::patch('/{user}/toggle-block', 'UserController@toggleBlockedStatus')->name('toggle-block')->where('user', '[0-9]+');
    Route::post('/{user}/password-reset-email', 'UserController@sendPasswordResetEmail')->name('password-reset-email')->where('user', '[0-9]+');
});

Route::resource(
    'users', 'UserController', ['only' => [
        'index', 'edit', 'update', 'destroy', 'create', 'store'
    ]]
);
