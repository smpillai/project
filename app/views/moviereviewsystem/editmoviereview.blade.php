@extends('layout.main')

@section('content')
<br/>
<h2> Edit Review: </h2>
<br/>

<form action="{{ URL::route('moviereviewsystem-edit-movie-review-post', $review->id)}}" method="post" >


<div class="field">
	Rating (between 1 and 10):
  	<input type="number" name="rating" min="0" max="10" value="{{$review->rating}}">
</div>

<p> Review Content: </p>

<div class="field">
		<textarea name="content" rows="10" cols="100" > {{$review->content}}</textarea>
		@if($errors->has('content'))
		{{$errors->first('content')}}
		@endif
</div>

<br/>
<br/>

	<input type="submit" value="Edit Movie Review">
	{{Form::token()}}
</form>

@stop