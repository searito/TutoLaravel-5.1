@extends('layaouts.home')
@section('title', 'Validando Formularios')
@section('description', 'Formularios En Laravel')
@section('keywords', 'Palabras, Claves, Del Contenido')

@section('content')

	<h1 class="text-center text-primary">Validación De Campos</h1>

	<div class="text-success" id="result" title="Mensaje De Searito's">
		@if(Session::has('message'))
			{{Session::get('message')}}
		@endif
	</div>

	<form action="{{url('home/validarmiformulario')}}" method="POST" class="form-horizontal" id="form">
		<div class="row container">
			<div class="col-xs-12 col-sm-5 col-md-5">
				<div class="form-group">
					<label for="nombre" class="control-label">Nombre</label>
					<input type="text" name="nombre" value="{{Input::old('nombre')}}" placeholder="Escribe Tu Nombre" class="form-control" autofocus>
					<div class="text-danger" id="error_nombre">{{$errors->formulario->first('nombre')}}</div>
				</div>
			</div>
			
			<div class="col-sm-1 col-md-2"></div>

			<div class="col-xs-12 col-sm-5 col-md-5">
				<div class="form-group">
					<label for="correo" class="control-label">Correo Electrónico</label>
					<input type="email" name="email" value="{{Input::old('email')}}" placeholder="Ingresa Tu Correo Electrónico" class="form-control">
					<div class="text-danger" id="error_email">{{$errors->formulario->first('email')}}</div>
				</div>
			</div>
		</div>

		{{csrf_field()}}

		<div class="row">
			<div class="col-sx-12 col-sm-3 col-md-4"></div>
			
			<div class="col-sx-12 col-sm-3 col-md-4">
				<button type="submit" class="btn btn-primary btn-block">Enviar</button><br>
			</div>

			<div class="col-sx-12 col-sm-3 col-md-4"></div>
		</div>
	</form>

	<script>
		$(function(){
			$("#form").submit(function(e){
				var fields = $(this).serialize();
				$.post("{{url('home/validarmiformulario')}}", fields, function(data){
					
					if (data.valid !== undefined){
						//$("#result").html("Formulario Enviado Éxitosamente.");
						$("#result").dialog({
							resizable: false,
							height: "auto",
							width: 500,
							modal: true,
							buttons: {
								"OK": function(){
									$(this).dialog("close");
								}
							}
						});
						$("#result").text("Formulario Enviado Éxitosamente.");

						$("#form")[0].reset();
						$("#error_nombre").html('');
						$("#error_email").html('');
					}else{

						$("#error_nombre").html('');
						$("#error_email").html('');

						if(data.nombre !== undefined){
							$("#error_nombre").html(data.nombre);
						}

						if(data.email !== undefined){
							$("#error_email").html(data.email);
						}
					}
				});

				return false;
			});
		});
	</script>

@stop