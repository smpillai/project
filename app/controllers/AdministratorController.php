<?php

class AdministratorController extends BaseController
{

	public function getSignIn()
	{
		return  View::make('administrator.signin');
	}
	
	public function postSignIn()
	{
		$validator = Validator::make(	Input::all(), 
										array(
											   'email'  			=> 'required|email',
											   'password'  			=> 'required'
											 )
									);


		if($validator->fails())
		{
			return Redirect::route('administrator-sign-in')->withErrors($validator)->withInput();
		}
		else
		{
			//$remember = (Input::has('remember')) ? true : false;
			$user = User::where('email', '=', Input::get('email'))->where('username', '=', 'administrator');

			if($user->count())
			{
				$user = $user->first();
			
				$auth = Auth::attempt( 
										array
										(
											'email' => Input::get('email'),
											'password' => Input::get('password')
										)
									 );

				if($auth)
				{
					return Redirect::route('moviereviewsystem-index-movie')
									->with('message', 'You are most welcome in Movie Review system.');
				}
				else
				{
					return Redirect::route('administrator-sign-in')
					->with('message', 'There are problem in signing Administrator, You entered wrong password.');
				}
			}
			else
			{
				return Redirect::route('administrator-sign-in')
					->with('message', 'There are problem in signing you, Either You are not an Administrator or entered Email is not correct.');
			}

		}

		return  Redirect::route('administrator-sign-in')->with('message', 'There are problem in signing You as Administrator.');
	}


	public function getSignOut()
	{
		Auth::logout();
		return Redirect::route('home')->with('message', 'Administrator got successfully signed out!!!');
	}

	
}