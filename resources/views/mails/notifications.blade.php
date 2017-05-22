<a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-envelope-o"></i>
    <span class="label label-success" >{{$coun}}</span>
</a>
<ul class="dropdown-menu">
    <li class="header">{{$msj}}</li>
    <li>
        <!-- inner menu: contains the messages -->
        <ul class="menu">
          @foreach($mensajesultimos as $value)


            <li><!-- start message -->
                <a href="./chats">
                    <div class="pull-left">
                        <!-- User Image -->
                        @if($value->from==Auth::user()->id)
                        <img src="{{fotoperfil($value->to)}}" class="img-circle" alt="User Image"/>
                      	</div>
                        <h4>
                            {{validarUsuario($value->to)}}
                            <small><i class="fa fa-clock-o"></i> {{$value->fecha}} </small>
                        </h4>
                        @else
                          <img src="{{fotoperfil($value->from)}}" class="img-circle" alt="User Image"/>
                      	</div>
                        <h4>
                          {{validarUsuario($value->from)}}
                            <small><i class="fa fa-clock-o"></i> {{$value->fecha}} </small>
                        </h4>
                        @endif

                    <!-- Message title and timestamp -->

                    <!-- The message -->
                    <p>{{$value->mensaje}}</p>
                </a>
            </li><!-- end message -->
        @endforeach
        </ul><!-- /.menu -->
    </li>
    <li class="footer"><a href="./chats">mensajes</a></li>
</ul>
