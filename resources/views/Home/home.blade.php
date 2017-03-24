@extends('layaouts.home')
@section('title', 'Curso Laravel')

@section('content')

<h1 class="text-primary text-justify">Bienvenid@ A Mi Primer App Laravel</h1>


@if (Session::has('status'))
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
		{{Session::get('status')}}
	</div>
@endif

@if (Session::has('error'))
	<div class="alerta" title="Mensaje Del Programador">
		{{Session::get('error')}}
	</div>
@endif

@if (Auth::check())
	<form method="post" action="{{url('user/createcomment')}}">
		{{csrf_field()}}
		<div class="form-group">
			<div class="row">
				<div class="col-md-1">
					<img src="{{url(Auth::user()->perfiles)}}" class='img-responsive img-rounded' style='max-width: 60px' />
					<strong><a href="{{url('home/user/'.Auth::user()->id)}}">{{Auth::user()->name}}</a></strong>
				</div>
				<div class="col-md-6">
					<textarea name="comment" class="form-control"></textarea>
					<br />
					<button type="submit" class="btn btn-primary">Publicar</button>
				</div>
			</div>
		</div>
	</form>
	<hr />
	
        <?php 
        #$comments = App\Comments::select()->orderBy('id', 'desc')->get(); #CONSULTA MYSQL EN LARAVEL
        #$comments = App\Comments::select()->orderBy('id', 'desc')->paginate(2);
        $comments = App\Comments::select()->orderBy('id', 'desc')->simplePaginate(2);
        $modal = 0;
        foreach($comments as $comment):
            $user = App\User::select()->where('id', '=', $comment->id_user)->first();
        ?>
        <div class="row">
            <div class="col-md-1">
                <img src='{{url($user->perfiles)}}' class='img-responsive img-rounded' style='max-width: 60px' />
                <strong><a href="{{url('home/user/'.$user->id)}}">{{$user->name}}</a></strong>
            </div>
            <div class='col-md-6'>
               <blockquote style="font-size:1.2em;">
               	{{$comment->comment}} <br>
               	<footer>
               		Fecha: {{$comment->date}} · Hora: {{$comment->time}}
               	</footer>

               	@if($comment->id_user == Auth::user()->id)

               	<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteComment{{$modal}}" title="Eliminar Comentario">
                  <span class="glyphicon glyphicon-remove"></span>
                </button>

                <!-- Ventana modal para eliminar -->
				<div class="modal fade" id="deleteComment{{$modal}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
								<h4 class="modal-title text-center text-primary" id="myModalLabel">Desear Eliminar Este Comentario?</h4>
							</div>

							<div class="modal-body">
								<form action="{{url('user/deletecomment')}}" method="POST">
									{{csrf_field()}}
									<input type="hidden" name="id_comment" value="{{$comment->id}}">

									<button type="sumit" class="btn btn-danger btn-sm" title="Eliminar Comentario" style="margin-top:1%;">
										<span class="glyphicon glyphicon-remove"> </span> Eliminar
									</button>
								</form>			
							</div>

							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
							</div>
						</div>
					</div>
				</div>

                <!-- Botón para abrir la ventana modal de editar -->
				<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editComment{{$modal}}" title="Editar Comentario">
					<span class="glyphicon glyphicon-pencil"></span>
				</button>

                <!-- Ventana modal editar -->
				<div class="modal fade" id="editComment{{$modal}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

								<h4 class="modal-title" id="myModalLabel">Editar Comentario</h4>
							</div>

							<div class="modal-body">
								<form method="post" action="{{url('user/editcomment')}}">
									{{csrf_field()}}
										<div class="form-group">
											<textarea name="comment" rows="10" class="form-control">{{$comment->comment}}</textarea>
										</div>
										
										<input type="hidden" name="id_comment" value="{{$comment->id}}" />
										<button type="submit" class="btn btn-primary">Actualizar</button>
								</form>
							</div>

							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
							</div>
						</div>
					</div>
				</div>

				<?php $modal++; ?>	
               	@endif
               </blockquote>
            </div>
        </div>
        <hr />
        <?php endforeach ?>

        <div class="text-center">
        	<?php $comments->setPath(''); ?>
        	<?php echo $comments->render(); ?>
        	<p><small>Pág. {{$comments->currentPage()}}</small></p>
        </div>

@else
	<hr />
	<p class="bg-danger text-capitalize" style="padding: 20px;">
		Para poder publicar comentarios tienes que <a href="{{url('auth/login')}}">
		<b class="text-uppercase">iniciar sesión</b></a>
	</p>
	<hr />
@endif

@stop()