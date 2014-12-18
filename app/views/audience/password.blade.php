@extends('layout.main')

@section('content')
<br/>
<br/>
<br/>
<br/>
<form action="{{ URL::route('audience-change-password-post')}}" method="post">

	<div class="field">
		Old Password: <input type="password" name="password_old">
		@if($errors->has('password_old'))
		{{$errors->first('password_old')}}
		@endif
	</div>

	<div class="field">
		New Password: <input type="password" name="password">
		@if($errors->has('password'))
		{{$errors->first('password')}}
		@endif
	</div>

	<div class="field">
		New Confirm Password: <input type="password" name="password_confirm">
		@if($errors->has('password_confirm'))
		{{$errors->first('password_confirm')}}
		@endif
	</div>

	<br/>
	<br/>
	<input type="submit" value="Change Password">
	{{Form::token()}}
</form>

@stop