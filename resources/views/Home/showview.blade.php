@extends('layaouts.home')
@section('title', 'Plantilla Base')
@section('description', 'Primer Form En Laravel')
@section('keywords', 'Palabras, Claves, Del Contenido')

@section('content')

<h1 class="">Primer Vista Generada En Laravel</h1>

{{$msg}}

@foreach ($array as $index => $val)
	<p class=""> {{$index}} = {{$val}} </p>
@endforeach

@stop