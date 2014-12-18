@extends('layout.main')

@section('content')
<h1> {{$movie->moviename}}</h1>

<br/>

<a href="{{ URL::route('moviereviewsystem-add-movie-review', $movie->id)}}" >Add New Review</a> 

<br/>
<h2> Reviews for the selected Movie: </h2>

	@foreach($reviews as $review)
	@if( $movie->id == $review->movieid )
	<li> <a href="{{ URL::route('moviereviewsystem-view-review', $review->id)}}" > {{$review->content}} </a> </li>
	@endif
	@endforeach

<br/>

<a href="{{ URL::route('moviereviewsystem-index-movie')}}" >Goto Movie List:</a> 

@stop