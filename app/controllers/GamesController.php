<?php

class GamesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /games
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /games/create
	 *
	 * @return Response
	 */
	public function create()
	{
        if (Auth::check()) $current_user = Auth::id();
        else $current_user = Input::get('sess_id');

        $other_user = Input::get('user_id');

        //$existingGames = Game::where('first_player_id', '=', $current_user)->where('second_player_id', '=', $other_user)->first();
        //if ($existingGames->id) $existingGames = Game::where('first_player_id', '=', $other_user)->where('second_player_id', '=', $current_user)->first();
        //if ($existingGames->id) return $existingGames;

        if ($game = Game::where('first_player_id', '=', $other_user)->where('second_player_id', '=', $current_user)->first()) {
            return $game;
        } elseif ($game = Game::where('first_player_id', '=', $current_user)->where('second_player_id', '=', $other_user)->first()) {
            return $game;
        }

        $game = new Game();
        $game->first_player_id = $current_user;
        $game->second_player_id = $other_user;
        $game->save();

        return $game;

	}

	/**
	 * Store a newly created resource in storage.
	 * POST /games
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /games/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /games/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /games/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /games/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}