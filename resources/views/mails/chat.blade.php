<div class="col-md-6">
    <!-- DIRECT CHAT SUCCESS -->
    <div class="box box-success direct-chat direct-chat-success">
      <div class="box-header with-border">
        <h3 class="box-title">Mensajes</h3>

        <div class="box-tools pull-right">
          <span data-toggle="tooltip" title="3 New Messages" class="badge bg-green">{{$contador}}</span>
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
          <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle">
            <i class="fa fa-comments"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <!-- Conversations are loaded here -->
        <div class="direct-chat-messages" id="mensaje">
          <!-- Message. Default to the left -->
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

          <!-- /.direct-chat-msg -->

          <!-- Message to the right -->

          <!-- /.direct-chat-msg -->
        </div>
        <!--/.direct-chat-messages-->

        <!-- Contacts are loaded here -->
        <div class="direct-chat-contacts">
          <ul class="contacts-list">
            @foreach ($usuarios as $usuario)
            <li>
              <a href="javascript:nuevochatf({{$usuario->id}})">
                <img class="contacts-list-img" src="{{$usuario->link_perfil}}" alt="User Image">

                <div class="contacts-list-info">
                      <span class="contacts-list-name">
                        {{validarUsuario($usuario->id)}}
                        <small class="contacts-list-date pull-right">2/28/2015</small>
                      </span>
                  <span class="contacts-list-msg">How have you been? I was...</span>
                </div>
                <!-- /.contacts-list-info -->
              </a>
            </li>

            @endforeach
            <!-- End Contact Item -->
          </ul>
          <!-- /.contatcts-list -->
        </div>
        <!-- /.direct-chat-pane -->
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <form role="form" enctype="multipart/form-data" id="fo3" method="POST" name="fo3" action="{{ url('enviarmensaje') }}">
        {{ csrf_field() }}
          <div class="input-group">
            <input type="text" name="message" placeholder="Nuevo mensaje ..." class="form-control">
            <input type="hidden" id="idm" name="id_m" value="{{$mensajeid}}">
                <span class="input-group-btn">
                  <button type="submit" class="btn btn-success btn-flat">enviar</button>
                </span>
          </div>
        </form>
      </div>

      <!-- /.box-footer-->
    </div>
    <!--/.direct-chat -->
  </div>

<script type="text/javascript">
function nuevochatf(id) {
$("#chat").load("{!!url('/newchatid?id="+id+"')!!}");
}
  $(document).ready(function() {
    setInterval(actualizar,5000);
    function actualizar() {
      id=document.getElementById("idm").value;
      $("#mensaje").load("{!!url('/actualizar?id="+id+"')!!}");
    }
     // Esta primera parte crea un loader no es necesaria
      $().ajaxStart(function() {
          $('#loading').show();
          $('#result').hide();
      }).ajaxStop(function() {
          $('#loading').hide();
          $('#result').fadeIn('slow');
      });

     // Interceptamos el evento submit
      $('#form, #fat, #fo3').submit(function() {
    // Enviamos el formulario usando AJAX
          $.ajax({
              type: 'POST',
              url: $(this).attr('action'),
              data: $(this).serialize(),
              // Mostramos un mensaje con la respuesta de PHP
              success: function(data) {
                  $('#result').html(data);
              }
          })
          id=document.getElementById("idm").value;
          document.getElementById("fo3").reset();
          $("#mensaje").load("{!!url('/actualizar?id="+id+"')!!}");

          return false;

      });
  })
  // ]]></script>
