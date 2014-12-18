<?php

class AudienceProfileController extends BaseController 
{

	
	public function user($username)
	{
	
		$user = User::where('username', '=', $username);
		if($user->count())
		{
			$user = $user->first();
			return View::make('audience.profile.user')->with('user', $user);
		}
		else
		{
			return Redirect::route('home')->with('message', 'Not a valid user.');
		}
	}

}
