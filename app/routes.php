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
    if (Auth::check()) return Redirect::route('friends');

	return View::make('hello');
});
Route::get('/login', function(){
    return View::make('login');
});

Route::resource('/user', 'UsersController');
Route::get('/logout', function(){
    Auth::logout();
    return Redirect::to('/');
});

Route::get('/fbver', 'UsersController@facebook');
Route::get('/friendslist', ['as' => 'friends', function(){

    $friends = User::all();

    echo '<h1>Your awesome friends</h1>';
    foreach ($friends as $f) :
        echo $f['email'].'<br />';
    endforeach;

    return '<br /><br /> <a href="/logout">Yeah, or logout here, or whatever you prefer...</a>';
}]);