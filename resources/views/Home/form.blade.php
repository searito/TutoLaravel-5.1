@extends('layaouts.home')
@section('title', 'Plantilla Base Para Form')
@section('description', 'Primer Form En Laravel')
@section('keywords', 'Palabras, Claves, Del Contenido')

@section('content')

<h1>Usando Método POST En Formularios</h1>

<form action="{{url('home/form')}}" method="POST" class="form-inline">

	<div class="form-group">
		<div class="input-group">
			<label for="nombre" class="text-primary sr-only">Nombre:</label>
			<div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
			<input type="text" name="name" value="{{$name}}" placeholder="Ingresa Tu Nombre" class="form-control">
		</div>
	</div>
	{{csrf_field()}}
	<button type="submit" class="btn btn-primary">Enviar</button>
</form>

<p class="lead">
	Valor del Campo name = {{$name}} <br>

	<div id="respuesta" title="Mensaje Del Sistema"></div>

	<button class="btn btn-danger" id="btn">Prueba</button>
</p>
<script>
	$(function(){
		$("#btn").click(function(){
			$("#respuesta").dialog({
				modal: true,
				resizable: false,
				height: "auto",
				width: 450,
				buttons: {
					OK: function(){
						$(this).dialog("close");
					}
				}
			});
			$("#respuesta").text('Este Es Un Mensaje Generado Gracias A Jquery UI...');
		});
	});
</script>
@stop