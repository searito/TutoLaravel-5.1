<h1 class="text-center text-primary">Bienvenid@ {{$data['name']}}</h1>

<a href="{{url()}}/auth/confirm/email/{{$data['email']}}/confirm_token/{{$data['confirm_token']}}" class="">Confirmar Mi Cuenta</a>