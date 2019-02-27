<?php

$c = (object)[
    'dashboardController'   => 'Admin\\'.DashboradController::class,
    'userController'        => 'Admin\\'.UsersController::class
];

Route::group(['prefix' => 'admin'], function () use($c){

    Route::get('/dashboard', $c->dashboardController.'@index')->name('admin.dashboard');


    Route::group(['prefix'   => 'users'], function() use($c){

        Route::get('/', $c->userController.'@index')->name('admin.users.index');


    });
});