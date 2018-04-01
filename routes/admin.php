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

Route::post('/users/{user}/update-roles', 'UsersController@updateRoles')->name('users.update-roles');

Route::resource(
    'users', 'UsersController', ['only' => [
        'index', 'edit', 'update'
    ]]
);
