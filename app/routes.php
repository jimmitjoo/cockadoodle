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
Route::get('/login', function(){
    return View::make('login');
});

Route::resource('/user', 'UsersController');

Route::get('/fbver', 'UsersController@facebook');
Route::get('/friendslist', function(){
    return 'Vänlista placeras här.';
});