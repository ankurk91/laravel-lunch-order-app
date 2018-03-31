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

Route::resource(
    'users', 'UsersController', ['only' => [
        'index', 'edit', 'update'
    ]]
);
