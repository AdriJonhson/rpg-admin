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

$c = (object)[
    'rpgController'         => RpgController::class
];


Route::get('/', 'Admin\\Auth\\LoginController@showLoginForm')->name('admin.form.login');
Route::post('/', 'Admin\\Auth\\LoginController@login')->name('login');
Route::post('/logout', 'Admin\\Auth\\LoginController@logout')->name('admin.logout');

Route::get('/register', 'Admin\\Auth\\RegisterController@showRegistrationForm')->name('admin.form.register');
Route::post('/register', 'Admin\\Auth\\RegisterController@register')->name('admin.form.create');

Route::group(['middleware' => 'auth'], function() use($c){
    Route::group(['prefix'  => 'rpgs'], function() use($c){
        Route::get('/', $c->rpgController.'@index')->name('rpg.index');
        Route::post('/', $c->rpgController.'@store')->name('rpg.store');
    });
});