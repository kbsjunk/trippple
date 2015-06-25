<!DOCTYPE html>
<html lang="en">
<head>
	<script src="{{ asset('js/angular-booter.js') }}"></script>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel</title>

	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('css/selectize.css') }}" rel="stylesheet">

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<script>
		window.trippple = new AngularBooter('trippple');
		trippple.dependencies.push('selectize');
	</script>
	@yield('styles')
</head>
<body ng-app="trippple">

	@include('partials.nav')
	@include('partials.errors')

	@yield('content')

	<!-- Scripts -->
	<script src="{{ asset('js/jquery.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('js/angular.js') }}"></script>
	<script src="{{ asset('js/selectize.min.js') }}"></script>
	<script src="{{ asset('js/angular-selectize.js') }}"></script>
	{{-- <script src="{{ asset('js/app.js') }}"></script> --}}
	@yield('scripts')
	<script>
		trippple.boot();
	</script>
</body>
</html>
