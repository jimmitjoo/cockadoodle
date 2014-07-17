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
        $drawer     = Input::get('drawer_id');
        $receiver   = Input::get('receiver_id');
        $game       = Input::get('game_id');

        $newImg = imagecreatefromstring(base64_decode( $image ));
        imagepng($newImg , "doodle-" . time() . ' - ' . rand(0,1000) . ".png");

        $doodle = new Doodle();
        $gameRound = new GameRound();

        $doodle->drawer_id = $drawer;
        $doodle->doodle_uri = $image;
        $doodle->save();

        $gameRound->drawer_id = $drawer;
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