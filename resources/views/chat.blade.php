@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection

@section('main-content')

	<div class="row">
<section class="col-sm-6" style="padding-top:8fpx;padding-bottom:8px">
			<div class="panel panel-default" style="background-color:#605ca8">
			<div class="panel-heading titulopanel" id="titulo">
			<center><label class="labeltitle" style="font-size: 22px !important;" >MIS MENSAJES</label></center></div>
</div>
<div class="panel-body">
	<div id="msjs" class="table-responsive">
<table  class="table table-condensed table-striped table-hover">
	<thead>
<tr>
	<th class="col-sm-9"><center>De</center></th>
	<th class="col-sm-3"><center>Hora</center></th>
</tr>
	</thead>

		<tbody>
	@foreach($chat as $mensaje)
	<tr onclick="verchat({{$mensaje->id_chat}})">
	@if($mensaje->from==Auth::user()->id)
	<td>{{validarUsuario($mensaje->to)}}<br>
	@else
	<td>{{validarUsuario($mensaje->from)}}<br>
	@endif
		{{$mensaje->mensaje}}</td>
		<td>{{$mensaje->fecha}}</td>
	</tr>
	@endforeach

		</tbody>


</table>
   </div>
</div>
</section>
<div class="col-sm-5">
	<select   class="form-control select2" tabindex="-1" aria-hidden="true" id="usuario" name="usuario">
	@foreach($usuarios as $user)
	<option value="{{ $user->id }}">{{strtoupper($user->name)}}</option>
	@endforeach
	</select>
<a href="javascript:nuevochat()" class="btn btn-success">Nuevo chat</a>
</select>
</div>
<div class="col-ms-6" id="chat">

</div>

</div>

<script type="text/javascript">
$(document).ready(function() {
	setInterval(actualizar,5000);
	function actualizar() {
		$("#msjs").load("{!!url('/actualizarmsjs')!!}");
	}


});
function nuevochat() {
id=document.getElementById("usuario").value;
$("#chat").load("{!!url('/newchatid?id="+id+"')!!}");
}
	function verchat(id) {
$("#chat").load("{!!url('/chatid?id="+id+"')!!}");
	}
</script>

@endsection
