@extends('layaouts.home')
@section('title', 'Crear Admin')
@section('content')


<h1 class="text-center text-capitalize text-primary">Crear un nuevo administrador</h1>

<div class='bg-danger text-capitalize text-center' style='padding: 20px'>¡¡¡Una vez termines de crear el administrador desactiva esta acción-ruta!!!</div>
<hr />
    @if (Session::has('message'))
     <div id="alerta" title="Mensaje Del Programador">
         <script>
          $("#alerta").dialog({
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
     <hr />
    @endif

    @if (Session::has('error'))
     <div id="alertaerror" title="Mensaje Del Programador">
        <script>
          $("#alertaerror").dialog({
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

      {{Session::get('error')}}
     </div>
     <hr />
    @endif

<form method="POST" action="{{url('admin/createadmin')}}">
    {!! csrf_field() !!}

    <div class='form-group'>
        <label for="name">Nombre:</label>
        <input type="text" name="name" class="form-control" value="{{ old('name') }}" />
        <div class="text-danger">{{$errors->first('name')}}</div>
    </div>

    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" name="email" class="form-control" value="{{ old('email') }}" />
        <div class="text-danger">{{$errors->first('email')}}</div>
    </div>

    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" name="password">
        <div class="text-danger">{{$errors->first('password')}}</div>
    </div>

    <div class="form-group">
        <label for="password_confirmation">Confirmar Password:</label>
        <input type="password" class="form-control" name="password_confirmation">
    </div>

    <div>
        <button type="submit" class="btn btn-primary">Crear administrador</button>
    </div>
</form>
<br /><br /><br /><br />
@stop
