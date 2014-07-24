<?php

use CAD\ImageHandler;

class DrawingsController extends \BaseController {

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

        $data = ImageHandler::save_base64_image($image);

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


    public function draw()
    {
        return View::make('drawing');
    }

    public function hide()
    {
        $game = GameRound::where('game_id', '=', Input::get('game_id'))->orderBy('id', 'desc')->first();
        $lastCock = Doodle::where('id', '=', $game['doodle_id'])->first();

        return View::make('hiding')->with('cockuri', $lastCock['doodle_uri'])->with('cockid', $lastCock['id']);
    }

    public function create_hide()
    {
        $image = Input::get('data_uri');
        $hidden_doodle = Input::get('hidden_doodle_id');
        $receiver = Input::get('receiver_id');
        $game_id = Input::get('game_id');

        $data = ImageHandler::save_base64_image($image);

        // If directory doodles doesn't exists, create it
        if (!file_exists('doodles')) mkdir('doodles', 0777);

        // Set doodleName and create file
        $doodleName = "doodles/doodle-" . time() . '-' . rand(0,1000) . ".png";
        file_put_contents( $doodleName, $data );

        $doodle = new Doodle();
        $game = Game::find($game_id);
        $game->status = 2;
        $gameRound = new GameRound();

        $doodle->drawer_id = Auth::id();
        $doodle->doodle_uri = $doodleName;
        $doodle->hidden_doodle_id = $hidden_doodle;
        $doodle->save();

        $gameRound->drawer_id = Auth::id();
        $gameRound->receiver_id = $receiver;
        $gameRound->doodle_id = $doodle->id;
        $gameRound->game_id = $game_id;
        $gameRound->save();


    }

}