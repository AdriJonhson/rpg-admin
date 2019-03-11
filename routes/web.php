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

Route::get('/', function () {
    return view('site.welcome');
});

Route::group(['prefix' => 'admin'], function (){

    Route::get('/', 'Admin\\Auth\\LoginController@showLoginForm')->name('admin.form.login');
    Route::post('/', 'Admin\\Auth\\LoginController@login')->name('admin.login');
    Route::post('/logout', 'Admin\\Auth\\LoginController@logout')->name('admin.logout');

    Route::get('/register', 'Admin\\Auth\\RegisterController@showRegistrationForm')->name('admin.form.register');
    Route::post('/register', 'Admin\\Auth\\RegisterController@register')->name('admin.form.create');
});