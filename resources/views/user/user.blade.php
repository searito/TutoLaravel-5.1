@extends('layaouts.home')
@section('title', 'Perfil Usuario')
@section('content')

	<h1 class="text-center text-primary">Bienvenid@ {{Auth::user()->name}} A Su Panel De Control</h1>

	@if(Session::has('status'))
	<div id="respuesta" title="Mensaje Del Programador">
		<script>
			$("#respuesta").dialog({
				resizable: false,
				height: "auto",
				width: 450,
				modal: true,
				buttons: {
					"Cerrar": function(){
						$(this).dialog("close");
					}
				}
			});

		</script>

		{{Session::get('status')}}
	</div>
	@endif
	
	
	<div class="col-xs-6 col-sm-5 col-md-3">
		<div class="row">
			<img src="{{url(Auth::user()->perfiles)}}" title="Imagen De Perfil De {{Auth::user()->name}}" 
			     class="img-responsive img-thumbnail col-xs-offset-3 col-md-offset-2 col-md-offset-3" style="max-width: 150px;">

			<h4 class="text">Opciones: </h4>
			
			<ul class="list-group">
				<li class="list-group-item active"><a href="{{url('user/profile')}}" style="color:#fff;text-decoration:none;">Cambiar Imagen De Perfil</a></li>
				@if(Auth::user()->social == 0)
					<li class="list-group-item"><a href="{{url('user/password')}}" style="text-decoration:none;">Cambiar Contraseña</a></li>
				@endif
				<li class="list-group-item"><a href="{{url('home/user/'.Auth::user()->id)}}" style="text-decoration:none;">Ir A Mi Perfil</a></li>
				<li class="list-group-item"><a href="{{url('user/download')}}" style="text-decoration:none;">Descargar Términos y Condiciones</a></li>
			</ul>
		</div>
	</div>
@stop