<?php

class UsersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /users
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /users/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /users
	 *
	 * @return Response
	 */
	public function store()
	{

        if (
            (User::where('email', '=', Input::get('email'))->count() > 0) &&
            !Auth::attempt(['email' => Input::get('email'), 'password' => Input::get('password')])
        ) {

            return 'User has an account, bit the password is not correct';

        } else {

            $user = new User();
            $user->email = Input::get('email');
            $user->password = Hash::make(Input::get('password'));
            $user->save();

            Session::put('user_id', $user->id);

            return Redirect::route('friends');

        }

	}

	/**
	 * Display the specified resource.
	 * GET /users/{id}
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
	 * GET /users/{id}/edit
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
	 * PUT /users/{id}
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
	 * DELETE /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


    public function facebook()
    {

        // get data from input
        $code = Input::get( 'code' );

        // get fb service
        $fb = OAuth::consumer( 'Facebook' );

        // check if code is valid

        // if code is provided get user data and sign in
        if ( !empty( $code ) ) {

            // This was a callback request from facebook, get the token
            $token = $fb->requestAccessToken( $code );

            // Send a request with it
            $result = json_decode( $fb->request( '/me' ), true );

            if (User::where('facebook_identification', '=', $result['id'])->count() == 0) {

                $user = new User();
                $user->email = $result['email'];
                $user->facebook_identification = $result['id'];
                $user->save();

            }

            $u = User::where('facebook_identification', '=', $result['id'])->first();

            Session::put('user_id', $u->id);

            return Redirect::route('friends');

        }
        // if not ask for permission first
        else {
            // get fb authorization
            $url = $fb->getAuthorizationUri();

            // return to facebook login url
            return Redirect::to( (string)$url );
        }

    }

}