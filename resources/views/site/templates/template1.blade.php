<!DOCTYPE html>
<html>
<head>
	<title>{{$title ?? 'Curso de Laravel 5.3 - EspecializaTI'}}</title>
</head>
<body>
	@yield('content')
	@stack('scripts')
</body>
</html>