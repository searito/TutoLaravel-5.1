@extends('layaouts.home')
@section('title', 'Panel De Adminstrador')
@section('content')
	
	<h1 class="text-center text-primary">Bienvenid@ {{Auth::user()->name}} A Tu Panel De Admón.</h1>

@stop