<!DOCTYPE html>
<html>

<head> 
<title>
	Movie Review System
</title>
</head>

<body>
	@if(Session::has('message'))
		<p>{{Session::get('message')}} </p>
	@endif
	@include('layout.navigation')
	@yield('content')
</body>

</html>