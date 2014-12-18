@extends('layout.main')

@section('content')

<br/>
<p>Review Rating: {{$review->rating}} </p>
<p> {{$review->content}}</p>
@if( (Auth::user()->username == 'administrator') || (Auth::user()->id == $review->userid) )
<p><a href="{{ URL::route('moviereviewsystem-view-review-edit', $review->id)}}">Edit Review</a> |
<a href="{{ URL::route('moviereviewsystem-delete-movie-review-post', $review->id)}}">Delete Review</a></p>
@endif
<br/>
<a href="{{ URL::route('moviereviewsystem-add-movie-review-comment', $review->id)}}" >Add New Comment</a> 



<br/>
<h2> Comments on selected Review: </h2>

	@foreach($comments as $comment)
		@if( $review->id == $comment->reviewid )
			<li> 
				<p> {{$comment->content}} 
					@if( (Auth::user()->username == 'administrator') || (Auth::user()->id == $comment->userid) )
					 <a href="{{ URL::route('moviereviewsystem-comment-edit', $comment->id)}}" > Edit </a>  | 
					 <a href="{{ URL::route('moviereviewsystem-comment-delete-post', $comment->id)}}" > Delete </a>
					@endif
				</p>
			</li>
		@endif
	@endforeach

<br/>

<a href="{{ URL::route('moviereviewsystem-view-movie', $review->movieid)}}" > Goto Review List: </a>

@stop