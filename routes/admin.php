<?php

$c = (object)[
    'dashboardController'   => DashboradController::class,
    'userController'        => UsersController::class,
    'rpgController'         => RpgController::class
];

Route::group(['prefix' => 'admin'], function () use($c){

    Route::get('/dashboard', $c->dashboardController.'@index')->name('admin.dashboard');


    Route::group(['prefix'   => 'users'], function() use($c){

        Route::get('/', $c->userController.'@index')->name('admin.users.index');

    });

    Route::group(['prefix'  => 'rpgs'], function() use($c){
       Route::get('/', $c->rpgController.'@index')->name('rpg.index');
       Route::post('/', $c->rpgController.'@store')->name('rpg.store');
    });
});