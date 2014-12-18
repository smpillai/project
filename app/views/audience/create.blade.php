@extends('layout.main')

@section('content')
<br/>
<br/>
<br/>
<br/>

<form action="{{ URL::route('audience-create-post')}}" method="post">

	<div class="field">
		Email: <input type="text" name="email">
		@if($errors->has('email'))
		{{$errors->first('email')}}
		@endif
	</div>

	<div class="field">
		Username: <input type="text" name="username">
		@if($errors->has('username'))
		{{$errors->first('username')}}
		@endif
	</div>

	<div class="field">
		Password: <input type="password" name="password">
		@if($errors->has('password'))
		{{$errors->first('password')}}
		@endif
	</div>

	<div class="field">
		Confirm Password: <input type="password" name="password_confirm">
		@if($errors->has('password_confirm'))
		{{$errors->first('password_confirm')}}
		@endif
	</div>

	<br/>
	<br/>

	<input type="submit" value="Create Audience account.">
	{{Form::token()}}
</form>

@stop