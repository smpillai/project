@extends('layout.main')

@section('content')
<br/>
<br/>
<br/>
<br/>



<form action="{{ URL::route('moviereviewsystem-add-movie-post')}}" method="post">

<div class="field">
		Movie Name: <input type="text" name="moviename">
		@if($errors->has('moviename'))
		{{$errors->first('moviename')}}
		@endif
</div>

<br/>
<br/>

	<input type="submit" value="Add Movie">
	{{Form::token()}}
</form>


@stop