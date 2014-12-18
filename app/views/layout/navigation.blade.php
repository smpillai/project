<nav>
	<ul>
		<li> <a href="{{ URL::route('home')}}" >Home</a> </li>

		@if(Auth::check())
			@if(Auth::user()->username == 'administrator')
			<li> <a href="{{ URL::route('administrator-sign-out')}}" >Sign-Out</a> </li>
			@else
			<li> <a href="{{ URL::route('audience-sign-out')}}" >Sign-Out</a> </li>
			<li> <a href="{{ URL::route('audience-change-password')}}" >Change Password</a> </li>
			@endif
			<li> <a href="{{ URL::route('moviereviewsystem-index-movie')}}" >Movie List</a> </li>
		@else
			<li> <a href="{{ URL::route('administrator-sign-in')}}" >Administrator:Sign-in</a> </li>
			<li> <a href="{{ URL::route('audience-sign-in')}}" >Audience:Sign-in</a> </li>
			<li> <a href="{{ URL::route('audience-create')}}" >Audience:Sign-up</a> </li>
			<li> <a href="{{ URL::route('audience-forgot-password')}}" >Audience:Forgot Password</a> </li>
		@endif
	</ul>
</nav>