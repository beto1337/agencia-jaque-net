@foreach ($mensajes as $mensaje)
@if($mensaje->from==Auth::user()->id)
<div class="direct-chat-msg">
  <div class="direct-chat-info clearfix">
    <span class="direct-chat-name pull-left">Tu</span>
    <span class="direct-chat-timestamp pull-right">{{$mensaje->fecha}}</span>
  </div>
  <!-- /.direct-chat-info -->
  <img class="direct-chat-img" src="{{Auth::user()->link_perfil}}" alt="Message User Image"><!-- /.direct-chat-img -->
  <div class="direct-chat-text">
    {{$mensaje->mensaje}}
  </div>
  <!-- /.direct-chat-text -->
</div>
@else
<div class="direct-chat-msg right">
  <div class="direct-chat-info clearfix">
    <span class="direct-chat-name pull-right">{{validarUsuario($mensaje->from)}}</span>
    <span class="direct-chat-timestamp pull-left">{{$mensaje->fecha}}</span>
  </div>
  <!-- /.direct-chat-info -->
  <img class="direct-chat-img" src="{{fotoperfil($mensaje->from)}}" alt="Message User Image"><!-- /.direct-chat-img -->
  <div class="direct-chat-text">
    {{$mensaje->mensaje}}
  </div>
  <!-- /.direct-chat-text -->
</div>
@endif
@endforeach
