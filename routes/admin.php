<?php

$c = (object)[
    'dashboardController' => 'Admin\\'.DashboradController::class
];

Route::group(['prefix' => 'admin'], function () use($c){

    Route::get('/dashboard', $c->dashboardController.'@index')->name('admin.dashboard');




});