@extends('layout.main')

@section('content')
<br/>
<h2> Add New Comment: </h2>
<br/>

<form action="{{ URL::route('moviereviewsystem-add-movie-review-comment-post', $reviewid)}}" method="post" >


<p> Comment Content: </p>

<div class="field">
		<textarea name="content" rows="10" cols="100" ></textarea>
		@if($errors->has('content'))
		{{$errors->first('content')}}
		@endif
</div>

<br/>
<br/>

	<input type="submit" value="Add New Comment">
	{{Form::token()}}
</form>

@stop