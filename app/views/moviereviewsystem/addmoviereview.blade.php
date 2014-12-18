@extends('layout.main')

@section('content')
<br/>
<h2> Add New Review: </h2>
<br/>

<form action="{{ URL::route('moviereviewsystem-add-movie-review-post', $movieid)}}" method="post" >


<div class="field">
	Rating (between 1 and 10):
  	<input type="number" name="rating" min="0" max="10">
  	@if($errors->has('rating'))
		{{$errors->first('rating')}}
		@endif
</div>

<p> Review Content: </p>

<div class="field">
		<textarea name="content" rows="10" cols="100" ></textarea>
		@if($errors->has('content'))
		{{$errors->first('content')}}
		@endif
</div>

<br/>
<br/>

	<input type="submit" value="Add Movie Review">
	{{Form::token()}}
</form>

@stop