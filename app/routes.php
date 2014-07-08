<?php

// Views
Route::get('/', 'PagesController@start');
Route::get('/login', 'PagesController@login');

// User resources
Route::resource('/user', 'UsersController');
Route::get('/logout', 'SessionsController@destroy');
Route::post('/login', 'SessionsController@create');

// Logged in
Route::get('/fbver', 'UsersController@facebook');
Route::get('/friends', ['as' => 'friends', 'uses' => 'FriendsController@index']);

// Search friends
Route::post('/api/search', 'FriendsController@search')->before('logged_in');
//Route::post('/search', 'FriendsController@search')->before('logged_in');