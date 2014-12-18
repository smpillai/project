@extends('layout.main')

@section('content')
<br/>
@if(Auth::user()->username == 'administrator')
<a href="{{ URL::route('moviereviewsystem-add-movie')}}" >Add New Movie</a> 
@endif
<br/>
<h2> Movies in the Movie Review Database: </h2>
<ul>
	@foreach($movies as $movie)
	<li> <a href="{{ URL::route('moviereviewsystem-view-movie', $movie->id)}}" > {{$movie->moviename}} </a> </li>
	@endforeach
</ul>
@stop