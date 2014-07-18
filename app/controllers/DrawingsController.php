<?php

class DrawingsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /drawings
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /drawings/create
	 *
	 * @return Response
	 */
	public function create()
	{

        $image      = Input::get('data_uri');
        $receiver   = Input::get('receiver_id');
        $game       = Input::get('game_id');

        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $data = base64_decode( $image );

        // If directory doodles doesn't exists, create it
        if (!file_exists('doodles')) mkdir('doodles', 0777);

        // Set doodleName and create file
        $doodleName = "doodles/doodle-" . time() . '-' . rand(0,1000) . ".png";
        file_put_contents( $doodleName, $data );

        $doodle = new Doodle();
        $gameRound = new GameRound();

        $doodle->drawer_id = Auth::id();
        $doodle->doodle_uri = $doodleName;
        $doodle->save();

        $gameRound->drawer_id = Auth::id();
        $gameRound->receiver_id = $receiver;
        $gameRound->doodle_id = $doodle->id;
        $gameRound->game_id = $game;
        $gameRound->save();

	}

	/**
	 * Store a newly created resource in storage.
	 * POST /drawings
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /drawings/{id}
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
	 * GET /drawings/{id}/edit
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
	 * PUT /drawings/{id}
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
	 * DELETE /drawings/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}