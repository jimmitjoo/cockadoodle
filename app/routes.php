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
Route::get(
    '/friends',
    [   'as' => 'friends',
        'uses' => 'FriendsController@index'
    ])->before('auth');
Route::get('/drawingboard', 'DrawingsController@draw');
Route::get('/hidingboard', 'DrawingsController@hide');
Route::get('/gradeboard', 'DrawingsController@grade');

// Search friends
Route::get('/api/search', 'FriendsController@search');
//Route::post('/search', 'FriendsController@search')->before('logged_in');

// Api uris
Route::get('/api/facebook_auth', 'UsersController@facebook_external');
Route::get('/api/create_game', 'GamesController@create');
Route::post('/api/save_drawing', 'DrawingsController@create');
Route::post('/api/save_hiding', 'DrawingsController@create_hide');
Route::post('/api/grade_doodle', 'DrawingsController@create_grade');
Route::get('/api/get_review', 'DrawingsController@get_review');