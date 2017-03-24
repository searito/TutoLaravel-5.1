@extends('layaouts.home')
@section('title', 'Resultado De La Búsqueda')
@section('search', $search)
@section('content')
	<h3 class="text-center text-success">Resultado De La Búsqueda: {{$search}}</h3>

	@if(isset($message))
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
			{{$message}}
		</div>
	@endif


	@if (isset($comments))
<?php 
        $modal = 0;
        foreach($comments as $comment):
            $user = App\User::select()->where('id', '=', $comment->id_user)->first();
        ?>
        <div class="row">
            <div class="col-md-1">
                <img src='{{url($user->perfiles)}}' class='img-responsive' style='max-width: 60px' />
                <strong><a href="{{url('home/user/'.$user->id)}}">{{$user->name}}</a></strong>
            </div>
            <div class='col-md-6'>
               {{$comment->comment}} 
               <br />
               <i>Fecha: {{$comment->date}} · Hora: {{$comment->time}}</i>
               
               
               @if(isset(Auth::user()->id))
               @if($comment->id_user == Auth::user()->id)
               <hr />
                <!-- Botón que abre la ventana modal eliminar -->
                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteComment{{$modal}}" title="Eliminar Comentario">
                  <span class="glyphicon glyphicon-remove"></span>
                </button>

                <!-- Ventana modal para eliminar -->
                <div class="modal fade" id="deleteComment{{$modal}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="myModalLabel">¿Realmente Quieres Eliminar Este Comentario?</h4>
                      </div>
                      <div class="modal-body">
                        <form method="post" action="{{url('user/deletecomment')}}">
                            {{csrf_field()}}
                            <input type="hidden" name="id_comment" value="{{$comment->id}}" />
                            <button type="submit" class="btn btn-danger">Eliminar</button>
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
                            <button type="submit" class="btn btn-primary">Editar</button>
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                      </div>
                    </div>
                  </div>
                </div>
                <?php $modal++ ?>
               @endif
               @endif
            </div>
        </div>
        <hr />
        <?php endforeach ?>

        <?php 
          $currentPage = $comments->currentPage();
          $maxPages = $currentPage + 3;
          $firstPage = 1;
          $lastPage = $comments->lastPage();
          $nextPage = $currentPage + 1;
          $forwardPage = $currentPage - 1;
          $comments->setPath('');
        ?>

        <ul class="pagination">
          <li class="@if($currentPage == $firstPage){{'disabled'}}@endif">
            <a href="@if($currentPage>1){{$comments->url($firstPage)}}@else{{'#'}}@endif" class='btn'>Primera</a>
          </li>

          <li class="@if($currentPage == $firstPage){{'disabled'}}@endif">
            <a href="@if($currentPage>1){{$comments->url($forwardPage)}}@else{{'#'}}@endif" class='btn'>«</a>
          </li>

          @for($x=$currentPage;$x<$maxPages;$x++)
            @if($x <= $lastPage)
              <li class="@if($x==$currentPage){{'active'}}@endif">
                <a href="{{$comments->url($x)}}" class='btn'>{{$x}}</a>
              </li>
            @endif
          @endfor

          <li class="@if($currentPage==$lastPage){{'disabled'}}@endif">
            <a href="@if($currentPage<$lastPage){{$comments->url($nextPage)}}@else{{'#'}}@endif" class='btn'>»</a>
          </li>

          <li class="@if($currentPage==$lastPage){{'disabled'}}@endif">
            <a href="@if($currentPage<$lastPage){{$comments->url($lastPage)}}@else{{'#'}}@endif" class='btn'>Última</a>
          </li>
        </ul>
@endif
@stop