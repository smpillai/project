<?php


class AudienceController extends BaseController
{

	public function getCreate()
	{
		return  View::make('audience.create');

	}

	public function getSignIn()
	{
		return  View::make('audience.signin');
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
			return Redirect::route('audience-sign-in')->withErrors($validator)->withInput();
		}
		else
		{
			//$remember = (Input::has('remember')) ? true : false;
			$user = User::where('username', '!=', 'administrator')->where('email', '=', Input::get('email'))->where('active', '=', 1);

			if($user->count())
			{
				$user = $user->first();
			
				$auth = Auth::attempt( 
										array
										(
											'email' => Input::get('email'),
											'password' => Input::get('password'),
											'active' => 1
										)
									 );

				if($auth)
				{
					return Redirect::route('moviereviewsystem-index-movie')
									->with('message', 'You are most welcome in Movie Review system.');
				}
				else
				{
					return Redirect::route('audience-sign-in')
					->with('message', 'There are problem in signing you, You entered wrong password.');
				}
			}
			else
			{
				return Redirect::route('audience-sign-in')
					->with('message', 'There are problem in signing you, Either your account is not activated or you entered wrong Email or You are an Administrator.');

			}

		}

		return  Redirect::route('audience-sign-in')->with('message', 'There are problem in sign you in.');
	}


	public function getSignOut()
	{
		Auth::logout();
		return Redirect::route('home')->with('message', 'You got successfully signed out!!!');
	}

	public function postCreate()
	{
		
		$validator = Validator::make(	Input::all(), 
										array(
											   'email'  			=> 'required|max:50|email|unique:users',
											   'username'  			=> 'required|max:20|min:5|unique:users',
											   'password'  			=> 'required|min:6',
											   'password_confirm'   => 'required|same:password'
											)
									);


		if($validator->fails())
		{
			return Redirect::route('audience-create')->withErrors($validator)->withInput();
		}
		else
		{
			
			//Create account in Database
			$email = Input::get('email');
			$username = Input::get('username');
			$password = Input::get('password');
			$code = str_random(50);
			
			$audience = User::create( array(
											'email' => $email,
											'username' => $username,
											'password' => Hash::make($password),
											'code' => $code,
											'active' => 0
										 )
								   );
			
	
			if($audience)
			{
				Mail::send( 'emails.auth.activate', 
							array(  'link' => URL::route('audience-activate', $code),
									'username' => $username
								 ),	
							function($message)  use ($audience)
									{
										$message->to($audience->email, $audience->username)
										->subject('Activate your account in Movie Review system.');
									}								
						   );
			
				return Redirect::route('home')->with('message', 'Your account has been added in our Movie Review system. 
					Kindly check your email to acctivate your account');
			}
			
		}

		
	}

	public function getActivate($code)
	{
		$user = User::where('code', '=', $code)->where('active', '=', 0);

		if($user->count())
		{
			$user = $user->first();

			$user->active = 1;
			$user->code = '';
			if($user->save())
			{
				return Redirect::route('home')->with('message', 'Your account has been activated now. You can sign-in the system');

			}
		}

		return Redirect::route('home')->with('message', 'Your account activation got failed, Kindly try again...');
	}


	public function getChangePassword()
	{
		return View::make('audience.password');
	}

	public function postChangePassword()
	{
		$validator = Validator::make(	Input::all(), 
										array(
											   'password_old'  			=> 'required',
											   'password'  			=> 'required|min:6',
											   'password_confirm'   => 'required|same:password'
											)
									);


		if($validator->fails())
		{
			return Redirect::route('audience-change-password')->withErrors($validator);
		}
		else
		{
			$user = User::find(Auth::user()->id);
			$oldpassword = Input::get('password_old');
			$password = Input::get('password');

			if(Hash::check($oldpassword, $user->password))
			{
				$user->password = Hash::make($password);
				if($user->save())
				{
					return Redirect::route('home')->with('message', 'Your password has been changed.');
				}
			}
			else
			{
				return Redirect::route('audience-change-password')->with('message', 'Your entered wrong old password.');
			}

		}

		return Redirect::route('audience-change-password')->with('message', 'Your password could not be changed.');
	}

	public function getForgotPassword()
	{
		return View::make('audience.forgot');
	}

	public function postForgotPassword()
	{
		$validator = Validator::make(	Input::all(), 
										array(
											   'email'  			=> 'required|email'											  
											 )
									);


		if($validator->fails())
		{
			return Redirect::route('audience-forgot-password')->withErrors($validator)->withInput();
		}
		else
		{
			$user = User::where('email', '=', Input::get('email'));
			if($user->count())
			{
				$user = $user->first();
				$code = str_random(50);
				$password = str_random(10);
				$user->code = $code;
				$user->password_temp = Hash::make($password);	

				if($user->save())
				{
					
					Mail::send( 'emails.auth.recover', 
							array(  'link' => URL::route('audience-recover', $code),
									'username' => $user->username,
									'password' => $password
								 ),	
							function($message)  use ($user)
									{
										$message->to($user->email, $user->username)
										->subject('Activate your new password for your account in Movie Review system.');
									}								
						   );

					return Redirect::route('home')->with('message', 'We have emailed you new password for your account.');
				}
			}
		}

		return Redirect::route('audience-forgot-password')->with('message', 'Could not recover password for you.' );
	}

	public function getRecover($code)
	{
		$user = User::where('code', '=', $code)->where('password_temp', '!=', '' );
		if($user->count())
		{
			$user = $user->first();
			$user->password = $user->password_temp;
			$user->password_temp ='';
			$user->code = '';
			if($user->save())
			{
				return Redirect::route('home')->with('message', 'Your account has been recovered. Now you can use your new password to signed-in.');
			}
		}

		return Redirect::route('home')->with('message', 'Could not recover your account.');
	}
}