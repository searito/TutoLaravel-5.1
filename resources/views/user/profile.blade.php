@extends('layaouts.home')
@section('title', 'Actualizar Perfil')
@section('content')

<h1>Cambiar Imagen De Perfil</h1>
<form method='post' action='{{url("user/updateprofile")}}' enctype='multipart/form-data'>
	{{csrf_field()}}
	<div class='form-group'>
		<label for='image'>Imagen: </label>
		<input type="file" name="image" />
		<div class='text-danger'>{{$errors->first('image')}}</div>
	</div>
	<button type='submit' class='btn btn-primary'>Actualizar Imagen</button>
</form>
@stop