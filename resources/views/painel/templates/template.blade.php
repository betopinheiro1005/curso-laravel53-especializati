<!DOCTYPE html>
<html>
<head>
	<title>{{$title ?? 'Painel curso'}}</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="{{url('assets/painel/css/style.css')}}">
</head>
<body>

	<div class="container">
		@yield('content')	
	</div>
	
</body>
</html>