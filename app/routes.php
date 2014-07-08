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

// Views
Route::get('/', 'PagesController@startpage');
Route::get('/login', 'PagesController@login');

// User resources
Route::resource('/user', 'UsersController');
Route::get('/logout', 'SessionsController@destroy');
Route::post('/login', 'SessionsController@create');

// Logged in
Route::get('/fbver', 'UsersController@facebook');
Route::get('/friendslist', ['as' => 'friends', 'uses' => 'FriendsController@index'])->before('logged_in');