<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
 
        <!-- Sidebar user panel (optional) -->
        @if (Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{Auth::user()->link_perfil}}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('adminlte_lang::message.online') }}</a>
                </div>
            </div>
        @endif

        <!-- search form (Optional)
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="{{ trans('adminlte_lang::message.search') }}..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
        search form -->


        <!-- Sidebar Menu -->
  <ul class="sidebar-menu">
      <li class="header"> CONTROL</li>
      <!-- Optionally, you can add icons to the links -->
      @if(Auth::user()->id_perfil ==1)
      <li class="active"><a href="{{ url('admin') }}"><i class='fa fa-dashboard'></i> <span>MONITOR</span></a></li>
      @endif

      <li class="treeview">
            <a href="#"><i class='fa fa-suitcase'></i><span>MIS TAREAS</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
          <li><a  href="{{ url('home') }}"><i class='fa fa-eye'></i> <span>Ver</span></a></li>
          <li><a  href="./historial-ordenes"><i class='fa fa-search'></i> <span>Historial</span></a></li>
            </ul>
      </li>



@if(Auth::user()->id_perfil < 3 or Auth::user()->id_perfil > 4)
<li class="treeview">
    <a href="#"><i class='fa  fa-paper-plane'></i> <span>ORDENES</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
    <li><a  href="{{ url('/realizar-pedido') }}"><i class='fa fa-plus'></i> <span>Registrar</span></a></li>
    <li><a  href="./editarorden"><i class='fa fa-street-view'></i> <span>Editar</span></a></li>
      </ul>
</li>

@endif
@if(Auth::user()->id_perfil ==1)


      <li class="treeview">
          <a href="#"><i class='fa fa-user'></i> <span>CLIENTES</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
          <li><a  href="./buscarcliente"><i class='fa fa-search'></i> <span>Editar</span></a></li>
          <li><a  href="./registrarcliente"><i class='fa fa-user-plus'></i> <span>Registrar</span></a></li>

            </ul>
      </li>
      <li class="treeview">
          <a href="#"><i class='fa fa-shopping-cart'></i> <span>PLANES</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
              <li><a  href="./buscarplan"><i class='fa fa-search'></i> <span>Editar</span></a></li>
          <li><a  href="./registrarplan"><i class='fa fa-plus-square'></i> <span>Registrar</span></a></li>
            </ul>
      </li>

      <li class="treeview">
          <a href="#"><i class='fa fa-shopping-cart'></i> <span>PRODUCTOS</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
              <li><a  href="./buscarproducto"><i class='fa fa-search'></i> <span>Editar</span></a></li>
          <li><a  href="./registrarproducto"><i class='fa fa-plus-square'></i> <span>Registrar</span></a></li>
            </ul>
      </li>
      <li class="treeview">
          <a href="#"><i class='fa fa-user'></i> <span>USUARIOS</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
          <li><a  href="./registrar-usuario"><i class='fa fa-user-plus'></i> <span>Registrar</span></a></li>
      <li><a  href="/admin/registrar-perfil"><i class='fa  fa-users'></i> <span>Registar perfil</span></a></li>
          </ul>
      </li>
@endif

@if(Auth::user()->id_perfil ==2)


      <li class="treeview">
          <a href="#"><i class='fa fa-user'></i> <span>CLIENTES</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
          <li><a  href="./buscarcliente"><i class='fa fa-search'></i> <span>Editar</span></a></li>
          <li><a  href="./registrarcliente"><i class='fa fa-user-plus'></i> <span>Registrar</span></a></li>

            </ul>
      </li>
 @endif
 <li class="treeview">
     <a href="#"><i class='fa  fa-paper-plane'></i> <span>CHAT</span> <i class="fa fa-angle-left pull-right"></i></a>
     <ul class="treeview-menu">
     <li><a  href="{{ url('/chats') }}"><i class='fa fa-plus'></i> <span>Mensajes</span></a></li>
            </ul>
 </li>

  </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
