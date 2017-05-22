@extends('layouts.app')

@section('htmlheader_title')
	perfil
@endsection


@section('main-content')
@if(Session::has('flash_message'))
<div class="alert alert-danger alert-dismissable fade in">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Error!</strong> {{Session::get('flash_message')}}
</div>
@endif
	<div class="container spark-screen">
		<div class="row">
<table>
	<tr>
		<td>nombre</td>
		<td>{{Auth::user()->name}}</td>
	</tr>
	<tr>
		<td>email</td>
		<td>{{Auth::user()->email}}</td>
	</tr>
	<tr>
		<td>telefono</td>
		<td>{{Auth::user()->telefono_usuario}}</td>
	</tr>
	<tr>
		<td>direccion</td>
		<td>{{Auth::user()->direccion}}</td>
	</tr>
	<tr>
		<td>fecha de nacimiento</td>
		<td>{{Auth::user()->cumple}}</td>
	</tr>
</table>
<section class="col-lg-5" >
<form role="form" enctype="multipart/form-data" method="POST" action="{{ url('profile') }}">
{{ csrf_field() }}
  <div class="form-group">
    <label for="ejemplo_email_1">telefono</label>
    <input type="number" class="form-control" rows="3" id="telefono" name="telefono"
           placeholder="telefono">
  </div>
	<div class="form-group">
    <label for="ejemplo_email_1">direccion</label>
    <input type="text" class="form-control" rows="3" id="direccion" name="direccion"
           placeholder="ingrese los detalles de su pedido">
  </div>
	<div class="form-group">
    <label for="ejemplo_email_1">fecha de nacimiento</label>
    <input type="date" class="form-control" rows="3" id="cumpleanos" name="cumplenos"
           placeholder="ingrese los detalles de su pedido">
  </div>
	<div class="form-group">
    <label for="ejemplo_email_1">Foto de perfil</label>
    <input type="file" id="foto" name="foto">
  </div>
<label for=""><input type="checkbox" id="contra" name="cambiarcon" value="1">Cambiar Contraseña</label><br>
	<div  id="cambiar" style="display:none">
		<div class="form-group">
	    <label for="ejemplo_email_1">Nueva Contraseña</label>
	    <input type="Password" class="form-control" id="pass" name="pass"
	           placeholder="">
	  </div>
		<div class="form-group">
	    <label for="ejemplo_email_1">Confirmar Contraseña</label>
	    <input type="Password" class="form-control" id="pass2" name="pass2"
	           placeholder="">
	  </div>
</div>
  <button type="submit" class="btn btn-default">Enviar</button>
</form><br>

</section>

		</div>
	</div>

	<script>
	document.getElementById('contra').onclick = function() {
	element = document.getElementById("cambiar");
		check = document.getElementById("contra");
		if (check.checked) {
				element.style.display='block';

		}
		else {
				element.style.display='none';

		}
	}
	</script>
@endsection
