<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta name="description" content="@yield('descripcion')">
	<meta name="keywords" content="@yield('keywords')">
	<title>@yield('title')</title>

	<link rel="stylesheet" href="{{url()}}/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{url()}}/ui/jquery-ui.theme.min.css">
	<link rel="stylesheet" href="{{url()}}/ui/jquery-ui.structure.min.css">

	<script src="{{url()}}/bootstrap/js/jquery.js"></script>
	<script src="{{url()}}/bootstrap/js/bootstrap.min.js"></script>
	<script src="{{url()}}/ui/jquery-ui.min.js"></script>
</head>
<body>
	
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="{{url()}}">Tutorial Laravel</a>
			</div>

			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li><a href="{{url()}}">Inicio</a></li>
				</ul>
				
				<form action="{{url('home/searchredirect')}}" class="navbar-form navbar-left" role="search">
					<div class="form-group">
						<input type="text" name="search" placeholder="Buscar..." class="form-control" value="@yield('search')">
					</div>

					<button class="btn btn-default" type="submit">Buscar</button>
				</form>

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::check())
						@if(Auth::user()->user == 1)
							<li><a href="{{url('admin/admin')}}"><span class="glyphicon glyphicon-user"></span> Panel Admón</a></li>	
						@endif
						<li><a href="{{url('user')}}"><span class="glyphicon glyphicon-user"></span> {{Auth::user()->name}}</a></li>
						<li><a href="{{url('auth/logout')}}">Salir</a></li>
					@else
						<li><a href="{{url('auth/login')}}">Iniciar sesión</a></li>
					@endif
				</ul>
			</div>
		</div>
	</nav>

	<div class="container"><br><br>
		@yield('content')
	</div>
</body>
</html>
