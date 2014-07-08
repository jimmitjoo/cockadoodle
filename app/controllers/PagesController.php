<?php

class PagesController extends \BaseController {

	/**
	 * Display the first page.
	 *
	 * @return Response
	 */
	public function start()
	{
		return View::make('hello');
	}

	/**
	 * Display the login page
	 *
	 * @return Response
	 */
	public function login()
	{
		return View::make('login');
	}

}