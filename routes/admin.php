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

// Admin manages other users
Route::group(['prefix' => 'users', 'as' => 'users.',], function () {
    Route::patch('{user}/update-roles', 'UserActionController@updateRoles')->name('update-roles')->middleware('can:updateRoles,user');
    Route::patch('{user}/toggle-block', 'UserActionController@toggleBlockedStatus')->name('toggle-block')->middleware('can:toggleBlock,user');
    Route::post('{user}/password-reset-email', 'UserActionController@sendPasswordResetEmail')->name('password-reset-email')->middleware('can:passwordResetEmail,user');

    Route::get('/', 'UserController@index')->name('index');
    Route::get('create', 'UserController@create')->name('create');
    Route::post('/', 'UserController@store')->name('store');
    Route::get('{user}/edit', 'UserController@edit')->name('edit')->middleware('can:update,user');
    Route::put('{user}', 'UserController@update')->name('update')->middleware('can:update,user');
    Route::delete('{user}', 'UserController@destroy')->name('destroy')->middleware('can:delete,user');
});

// Orders to be created or updated for a user
Route::group(['prefix' => 'orders', 'as' => 'orders.'], function () {
    Route::get('create/{user}', 'OrderController@create')->name('create');
    Route::post('store/{user}', 'OrderController@store')->name('store');
    Route::patch('{order}/update-status', 'OrderController@updateStatus')->name('update-status');
});

Route::resource('orders', 'OrderController')
    ->only(['index', 'edit', 'update', 'destroy']);

Route::resource('products', 'ProductController')
    ->only(['index', 'edit', 'update', 'destroy', 'create', 'store']);

Route::resource('suppliers', 'SupplierController')
    ->only(['index', 'edit', 'update', 'destroy', 'create', 'store']);
