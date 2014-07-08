<?php

class SessionsController extends \BaseController {

    /**
     * Show the form for creating a new session.
     * GET /sessions/create
     *
     * @return Response
     */
	public function create()
	{
		if (Auth::attempt(['username' => Input::get('username'), 'password' => Input::get('password')])) return Redirect::route('friends');

        return Redirect::to('/');
	}

	/**
	 * Remove all current sessions for this user.
	 *
	 * @return Response
	 */
	public function destroy()
	{
		Auth::logout();

        return Redirect::to('/');
	}

}