<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('/xhprof/{id?}', [
	'as' => 'xhprof', 'uses' => 'WelcomeController@index'
]);

Route::get('/snake_xhprof/{id?}', [
	'as' => 'snake_xhprof', 'uses' => 'WelcomeController@snake_xhprof'
]);

Route::get('/config', 'ConfigController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
