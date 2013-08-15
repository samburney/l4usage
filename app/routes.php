<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::group(array('prefix' => 'admin'), function()
{
	Route::get('users', 'AdminController@getUserIndex');

	Route::get('user/{id}', 'AdminController@getUser');

	Route::get('user/edit/{id}', 'AdminController@getUserEdit');
	Route::post('user/edit/{id}', 'AdminController@postUserEdit');
});