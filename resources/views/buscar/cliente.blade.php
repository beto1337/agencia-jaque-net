@extends('layouts.app')

@section('htmlheader_title')
	CLIENTES
@endsection
@section('main-content')

@if(Session::has('delete_message'))

<div id="alerta" class="alert alert-success alert-dismissable fade in">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Bien!</strong> {{Session::get('delete_message')}}
</div>
@endif

@if(Session::has('flash_message'))
<div id="alerta" class="alert alert-success alert-dismissable fade in">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Bien!</strong> {{Session::get('flash_message')}}
</div>
@endif


<div class="container spark-screen">
<div class="row">

<section class="col-lg-12">
  <section  class="col-lg-4">
    <div class="panel panel-default" style="background-color:#605ca8">
    <div class="panel-heading" style="padding-bottom:0px;background-color:#605ca8;color:white">
    <center><label  style="padding:1px;text-shadow: black 0.1em 0.1em 0.2em;font-family:'Baloo Bhaina';font-size:15px" >BUSCAR CLIENTE</label></center></div>
    <div class="panel-body" style="background-color:#b0c4de;color:white;padding-top:15px;padding-bottom:5px;margin:2px;border-top-color:red">
<center>

    <section class="col-lg-11" >
     <select   class="form-control select2 select2-hidden-accessible "data-placeholder="" style="background-color:#605ca8;border-radius:2px" tabindex="-1" aria-hidden="true" id="cliente" name="cliente">
       <option value=""></option>
       @foreach($clientes as $cliente)
			 @if(empty($cliente->alias))
			 <option value="{{ $cliente->id_cliente }}">{{$cliente->nombre_cliente." ".$cliente->apellido_cliente}}</option>
			 @endif
       @if(!empty($cliente->alias))
			 <option value="{{ $cliente->id_cliente }}">{{$cliente->alias}}</option>
       @endif
			 @endforeach
     </select>
   </section>

  </center>
    <section class="col-lg-12" >
      <center>

   <div class="form-group">
    <div style="padding-top:10px" >
      <button type="submit" id="ver" style="width:40%"  class="myButton"><label  style="margin-bottom:0px;text-shadow: black 0.1em 0.1em 0.2em;font-family:'Baloo Bhaina';font-size:13px" >VER</label></button>
			<button type="submit" id="editar" style="width:58%"  class="myButton"><label  style="margin-bottom:0px;text-shadow: black 0.1em 0.1em 0.2em;font-family:'Baloo Bhaina';font-size:13px" >EDITAR/ELIMINAR</label></button>
		</div>
		</div>
  </center>
    </section>

    </div>
    </div>
  </section>


</section>
<div class="" id="show">




</div>
</div>
</div>

@if(Session::has('id'))

<script>
window.onload = function() {

url='vercliente?id={{Session::get('id')}}';
$("#show").load("{!!url('"+url+"')!!}");
};
document.getElementById('ver').onclick = function() {
	ele = document.getElementById("cliente").value;
	alerta=document.getElementById('alerta');
	alerta.style.display='none';
	element2 = document.getElementById("show");
		url='vercliente?id='+ele;

	$("#show").load("{!!url('"+url+"')!!}");
}
document.getElementById('editar').onclick = function() {
	ele = document.getElementById("cliente").value;

	element2 = document.getElementById("show");
		url='editarcliente?id='+ele;
	$("#show").load("{!!url('"+url+"')!!}");
}


</script>

@elseif(Session::has('delete_message'))
<script>
document.getElementById('ver').onclick = function() {
	ele = document.getElementById("cliente").value;
	alerta=document.getElementById('alerta');
	alerta.style.display='none';
	element2 = document.getElementById("show");
		url='vercliente?id='+ele;

	$("#show").load("{!!url('"+url+"')!!}");
}
document.getElementById('editar').onclick = function() {
	ele = document.getElementById("cliente").value;
	alerta=document.getElementById('alerta');
	alerta.style.display='none';
	element2 = document.getElementById("show");
		url='editarcliente?id='+ele;
	$("#show").load("{!!url('"+url+"')!!}");
}

</script>

@else
<script>
document.getElementById('ver').onclick = function() {
	ele = document.getElementById("cliente").value;

	element2 = document.getElementById("show");
		url='vercliente?id='+ele;

	$("#show").load("{!!url('"+url+"')!!}");
}
document.getElementById('editar').onclick = function() {
	ele = document.getElementById("cliente").value;

	element2 = document.getElementById("show");
		url='editarcliente?id='+ele;
	$("#show").load("{!!url('"+url+"')!!}");
}

</script>
@endif




@endsection
