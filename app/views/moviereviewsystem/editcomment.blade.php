@extends('layout.main')

@section('content')
<br/>
<h2> Edit Comment: </h2>
<br/>

<form action="{{ URL::route('moviereviewsystem-comment-edit-post', $comment->id)}}" method="post" >


<p> Comment Content: </p>

<div class="field">
		<textarea name="content" rows="10" cols="100" >{{$comment->content}}</textarea>
		@if($errors->has('content'))
		{{$errors->first('content')}}
		@endif
</div>

<br/>
<br/>

	<input type="submit" value="Edit Comment">
	{{Form::token()}}
</form>

@stop