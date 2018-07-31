<?php


/*
|---------------------------------------------------------------
| Admin related routes
|---------------------------------------------------------------
|
| Define routes that starts with /admin/ here
| All routes are already protected with 'role:admin' middleware
| Don't prefix your routes with `/admin/`
| Don't prefix controllers with `Admin\`
|
*/

Route::group(['prefix' => 'users', 'as' => 'users.', 'middleware' => 'can:manageUsers,user'], function () {
    Route::patch('/{user}/update-roles', 'UserActionController@updateRoles')->name('update-roles')->where('user', '[0-9]+');
    Route::patch('/{user}/toggle-block', 'UserActionController@toggleBlockedStatus')->name('toggle-block')->where('user', '[0-9]+');
    Route::post('/{user}/password-reset-email', 'UserActionController@sendPasswordResetEmail')->name('password-reset-email')->where('user', '[0-9]+');
});

Route::resource(
    'users', 'UserController', ['only' => [
        'index', 'edit', 'update', 'destroy', 'create', 'store'
    ]]
)->middleware(['can:manageUsers,user']);

// Order to be created or updated for a user
Route::group(['prefix' => 'orders', 'as' => 'orders.'], function () {
    Route::get('/create/{user}', 'OrderController@create')->name('create')->where('user', '[0-9]+');
    Route::post('/store/{user}', 'OrderController@store')->name('store')->where('user', '[0-9]+');
    Route::patch('/{order}/update-status', 'OrderController@updateStatus')->name('update-status')->where('order', '[0-9]+');
});

Route::resource(
    'orders', 'OrderController', ['only' => [
        'index', 'edit', 'update', 'destroy',
    ]]
);

Route::resource(
    'products', 'ProductController', ['only' => [
        'index', 'edit', 'update', 'destroy', 'create', 'store'
    ]]
);
