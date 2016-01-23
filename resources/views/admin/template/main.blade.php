<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>@yield('title', 'Blog Jose G') | Panel de Administracion </title>
	<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
	<link rel="stylesheet" href="{{ asset('plugin/bootstrap/css/bootstrap.css') }}">
	<link rel="stylesheet" href="{{ asset('plugin/chosen/chosen.css') }}">
	<link href='https://fonts.googleapis.com/css?family=Lato:900italic' rel='stylesheet' type='text/css'>
</head>
<body class="admin-body">

		@include('admin.template.partial.nav')

	
	<section class="section-admin">
		<div class=" back-grey">
				@yield('title')
		</div>
	
		<div class="panel panel-body">
			@include('flash::message')
			@yield('content')
		</div>
	</section>

	<footer class="admin-footer">
		<div class="navbar navbar-default">
			<div class="container-fluid">
				<div class="collapse navbar-collapse">
					<p class="navbar-text">Todos los derechos reservados &copy {{ date('Y') }}</p>
					<p class="navbar-text navbar-right"> Jose Gratereaux</p>
				</div>
			</div>
		</div>

	</footer>

	<footer>
		
	</footer>

	<script src="{{ asset('plugin/jquery/js/jquery-2.2.0.js') }}"></script>
	<script src="{{ asset('plugin/bootstrap/js/bootstrap.js') }}"></script>
	<script src="{{ asset('plugin/chosen/chosen.jquery.js') }}"></script>

	@yield('script')

</body>
</html>