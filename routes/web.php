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
    return 'Home';
});

Route::get('/usuarios', 'UserController@index')->name('users');

Route::get('/usuarios/{user}', 'UserController@show')->where('user', '[0-9]+')->name('users.show');

Route::get('/usuarios/nuevo', 'UserController@create')->name('users.create');

Route::post('/usuarios/nuevo', 'UserController@store')->name('users.store');

Route::get('/usuarios/{user}/editar', 'UserController@edit')->name('users.edit');

Route::put('/usuarios/{user}/editar', 'UserController@update')->name('users.update');

Route::delete('/usuarios/{user}/delete', 'UserController@destroy')->name('users.delete');

Route::get('/saludo/{name}/{nickname}', 'WelcomeUserController@welcomeWith');

Route::get('/saludo/{name}', 'WelcomeUserController@welcomeWithout');