@extends('layout.main')

@section('content')
<br/>
<br/>
<br/>
<br/>

<form action="{{ URL::route('audience-forgot-password-post')}}" method="post">
	<div class="field">
		Email: <input type="text" name="email">
		@if($errors->has('email'))
		{{$errors->first('email')}}
		@endif
	</div>
<br/>
<br/>

<input type="submit" value="Recover Password">
	{{Form::token()}}
</form>

@stop