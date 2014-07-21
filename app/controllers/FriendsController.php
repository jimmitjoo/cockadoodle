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
        $mygames = GameRound::with('receiver', 'drawer')->where('receiver_id', '=', Auth::id())->distinct('game_id')->orderBy('doodle_id')->get();

        return $mygames;

        return View::make('friendslist')->withMygames($mygames);
	}

    public function search()
    {
        $query = Input::get('query');
        if (strlen($query) > 1) {

            $users = User::where('username', 'LIKE', '%' . $query . '%')
                //->orWhere('email', 'LIKE', '%' . $query . '%')
                ->take(5)->get();

            return View::make('friendssearch')->withMatches($users);
        }
    }
}