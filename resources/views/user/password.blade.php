@extends('layaouts.home')
@section('title', 'Cambiar Contraseña')
@section('content')
	
	<h1 class="text-primary text-center">Cambiar Contraseña</h1>
	
	@if (Session::has('message'))
	
	<div class="alerta" title="Mensaje Del Programador">
		<script>
			$(".alerta").dialog({
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

		{{Session::get('message')}}
	</div>

	@endif

	<hr />

	<form method="post" action="{{url('user/updatepassword')}}">
		{{csrf_field()}}
		<div class="form-group">
			<label for="mypassword">Introduce Contraseña Actual:</label>
			<input type="password" name="mypassword" class="form-control">
			<div class="text-danger">{{$errors->first('mypassword')}}</div>
		</div>

		<div class="form-group">
			<label for="password">Introduce Contraseña Nueva:</label>
			<input type="password" name="password" class="form-control">
			<div class="text-danger">{{$errors->first('password')}}</div>
		</div>

		<div class="form-group">
			<label for="mypassword">Confirma Contraseña:</label>
			<input type="password" name="password_confirmation" class="form-control">
		</div>

		<button type="submit" class="btn btn-primary">Cambiar Contraseña</button>
	</form>
@stop