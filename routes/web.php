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
    'rpgController'     => RpgController::class,
    'cardController'    => CardController::class
];


Route::get('/', 'Admin\\Auth\\LoginController@showLoginForm')->name('admin.form.login');
Route::post('/login', 'Admin\\Auth\\LoginController@login')->name('login');
Route::post('/logout', 'Admin\\Auth\\LoginController@logout')->name('admin.logout');

Route::get('/register', 'Admin\\Auth\\RegisterController@showRegistrationForm')->name('admin.form.register');
Route::post('/register', 'Admin\\Auth\\RegisterController@register')->name('admin.form.create');

Route::group(['middleware' => 'auth'], function() use($c){

    Route::group(['prefix'  => 'rpgs'], function() use($c){
        Route::get('/', $c->rpgController.'@index')->name('rpg.index');
        Route::post('/', $c->rpgController.'@store')->name('rpg.store');
        Route::put('/edit/{rpg}', $c->rpgController.'@update')->name('rpg.update');
        Route::delete('/delete', $c->rpgController.'@delete')->name('rpg.delete');
        Route::post('{rpg}/add-player', $c->rpgController.'@addPlayer')->name('rpg.add.player');
    });

    Route::get('card/{rpg}/create', $c->cardController.'@create')->name('card.create');
    Route::post('card/{rpg}/create', $c->cardController.'@store')->name('card.store');
    Route::get('/get-card/{card}', $c->cardController.'@show')->name('card.get.info');

    Route::group(['middleware' => 'verify_card'], function() use($c){
        Route::get('/rpgs/{rpg}', $c->rpgController.'@startAdventure')->name('rpg.start');
    });

});
