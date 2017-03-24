@extends('layaouts.home')
@section('title', 'Perfil De Usuario')
@section('content')


<h1>Perfil Público De <a href="{{url('home/user/'.$user->id)}}">{{$user->name}}</a></h1>
<img src="{{url($user->perfiles)}}" class="img-responsive" style="max-width: 150px" />
<hr />

@if(Session::has('status'))
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
 <hr />
@endif

@if(Session::has('error'))
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

  {{Session::get('error')}}
 </div>
 <hr />
@endif

<!-- Si el usuario está autenticado -->
@if (Auth::check())
 <!-- Y este es su id de perfil posibilitar la creación de comentarios -->
  @if($user->id == Auth::user()->id)
 <form method="post" action="{{url('user/createcomment')}}">
  {{csrf_field()}}
  <div class="form-group">
   <div class="row">
    <div class="col-md-1">
     <img src="{{url(Auth::user()->perfiles)}}" class='img-responsive' style='max-width: 60px' />
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
 @endif
@endif
 <!-- Seleccionar los comentarios del usuario -->
 <?php 
  $modal = 0;
  $comments = App\Comments::where('id_user', '=', $user->id)->orderBy('id', 'desc')->simplePaginate(5);
  foreach($comments as $comment):
 ?>
  <div class="row">
            <div class="col-md-1">
                <img src='{{url($user->perfiles)}}' class='img-responsive' style='max-width: 60px' />
                <strong><a href="{{url('home/user/'.$user->id)}}">{{$user->name}}</a></strong>
            </div>
            <div class='col-md-6'>
              <blockquote style="font-size:1.1em;">
               {{$comment->comment}} 
               <br />
               <footer>
                 Fecha: {{$comment->date}} · Hora: {{$comment->time}}
               </footer>
      
      <!-- Si el usuario está autenticado, es decir, la propiedad id existe -->
      @if(isset(Auth::user()->id))
      <!-- Si el usuario está autenticado agregar las opciones editar y eliminar cuando visite en su perfil -->
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
                        <h4 class="modal-title text-capitalize" id="myModalLabel">¿Realmente quieres eliminar este comentario?</h4>
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
                        <h4 class="modal-title text-capitalize" id="myModalLabel">Editar comentario</h4>
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
      </blockquote>
   </div>
  </div>
  <hr />
 <?php endforeach ?>
 
 <!-- Agregar la paginación simple -->
 <div class='text-center'>
 <?php /*Nuevo*/ $comments->setPath('') ?>
 <?php echo $comments->render() ?>
    <p>Página {{$comments->currentPage()}}</p>
 </div>
 <br /><br /><br /><br />

@stop
