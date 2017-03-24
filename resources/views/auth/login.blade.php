@extends('layaouts.home')
@section('title', 'Login')
@section('content')

<div class="row">
<div class="col-md-4"></div>

<div class="col-xs-12 col-sm-12 col-md-4"><br>
  <div class="panel panel-primary" style="margin-top:5%;">
    <div class="panel-heading"><h1 class="text-center">Iniciar Sesión</h1></div>

    <div class="panel-body">
      <form method="post" action="{{url('auth/login')}}">
        {{csrf_field()}}
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" name="email" class="form-control" value="{{Input::old('email')}}" />
          <div class="text-danger">{{$errors->first('email')}}</div>
        </div>

        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" name="password" class="form-control" />
          <div class="text-danger">{{$errors->first('password')}}</div>
        </div>

        <div class="form-group">
          <label for="remember">No cerrar sesión:</label>
          <input type="checkbox" name="remember" />
        </div>
        

        <div class="col-xs-6 col-sm-6 col-md-6">
          <button type="submit" class="btn btn-primary">Iniciar sesión</button>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-6">
          <a href="{{url('auth/register')}}" class="btn btn-primary">Registrarme</a>
        </div>
      </form>
    </div>
  </div>
  <a href="{{url('password/email')}}" class="btn btn-warning btn-block">Olvidé Mi Contraseña</a>
</div>

<div class="col-md-4"></div>
</div>

<div class="row" style="margin-top:1%;">
  <div class="col-xs-12 col-sm-12 col-md-4"></div>
  <div class="col-xs-12 col-sm-12 col-md-4">
    <a href="{{url('social/facebook')}}" class="btn btn-primary btn-block">Inicia Sesión Con Facebook</a>
    <a href="{{url('social/google')}}" class="btn btn-danger btn-block">Accede Con Google+</a>
  </div>
  
  <div class="col-xs-12 col-sm-12 col-md-4"></div>
</div>

<br /><br />
@stop

