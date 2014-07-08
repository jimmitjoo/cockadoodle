<?php

class FriendsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /friends
	 *
	 * @return Response
	 */
	public function index()
	{
        $friends = User::all();

        return View::make('friendslist')->withFriends($friends);
	}

    public function search()
    {
        $users = User::where('username', 'LIKE', '%' . Input::get('username') . '%')->get();

        return $users;

        return View::make('friendssearch')->withMatches($users);
    }
}