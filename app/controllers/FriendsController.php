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
        $query = Input::get('query');
        return $query;


        $users = User::where('username', 'LIKE', '%' . $query . '%')->orWhere('email', 'LIKE', '%' . $query . '%')->get();

        return View::make('friendssearch')->withMatches($users);
    }
}