@extends('layout.main')

@section('content')
<br/>
<br/>
<br/>
<br/>

@if(Auth::check())
<p> Hello, {{Auth::user()->username}}, You are most welcome into Movie Review system!!! </p>
<br/>
<br/>

@else
<br/>
<br/>
<br/>
<br/>
<h1>You are not signed into Movie Review system!!!</h1>

@endif

@stop