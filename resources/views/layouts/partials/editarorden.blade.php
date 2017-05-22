@extends('layouts.app')

@section('htmlheader_title')
	EDITAR ORDEN
@endsection
@section('main-content')

<div class="container spark-screen">
<div class="row">

<section class="col-lg-12">
  <section  class="col-lg-4">
    <div class="panel panel-default" style="background-color:#605ca8">
    <div class="panel-heading" style="padding-bottom:0px;background-color:#605ca8;color:white">
    <center><label  style="padding:1px;text-shadow: black 0.1em 0.1em 0.2em;font-family:'Baloo Bhaina';font-size:15px" >BUSCAR ORDEN</label></center></div>
    <div class="panel-body" style="background-color:#b0c4de;color:white;padding-top:15px;padding-bottom:5px;margin:2px;border-top-color:red">
<center>

    <section class="col-lg-11" >
     <select   class="form-control select2 select2-hidden-accessible "data-placeholder="" style="background-color:#605ca8;border-radius:2px" tabindex="-1" aria-hidden="true" id="orden" name="orden">
       <option value=""></option>
       @foreach($requerimiento as $requerimiento)
       <option value="{{ $requerimiento->id_requerimiento }}">{{$requerimiento->nota_requerimiento ." ". validarUsuario($requerimiento->id_operador)}}</option>
       @endforeach
     </select>
   </section>

  </center>
    <section class="col-lg-12" >
      <center>

   <div class="form-group">
    <div style="padding-top:10px" >
      <button type="submit" id="ver" style="padding-left:50px;padding-right:50px"  class="myButton"><label  style="margin-bottom:0px;text-shadow: black 0.1em 0.1em 0.2em;font-family:'Baloo Bhaina';font-size:13px" >EDITAR</label></button>
    </div>
    </div>
  </center>
    </section>
    </div>
    </div>

  </section>
  <section  class="col-lg-12">
    <div class="panel panel-default" style="background-color:#605ca8">
    <div class="panel-heading" style="padding-bottom:0px;background-color:#605ca8;color:white">
    <center><label  style="padding:1px;text-shadow: black 0.1em 0.1em 0.2em;font-family:'Baloo Bhaina';font-size:15px" >BUSCAR ORDEN</label></center></div>
    <div class="panel-body" style="background-color:#b0c4de;color:white;padding-top:15px;padding-bottom:5px;margin:2px;border-top-color:red">

      <div class="table-responsive" >
        <table class="table table-condensed table-striped">

          <thead>
        <tr style="background-color:#b0c4de;text-shadow: black 0.1em 0.1em 0.2em;font-size:12px;color:white">


        <th class="col-sm-1"><center>PRIORIDAD</center></th>
        <th class="col-sm-2"><center>TIEMPO ENTREGA</center></th>
        <th class="col-sm-3"><center>CLIENTE</center></th>
        <th class="col-sm-4"><center>PRODUCTO</center></th>
        <th class="col-sm-1"><center>OPERADOR</center></th>
        <th class="col-sm-1"><center></center></th>

            </tr>
          </thead>

           <tbody id="tablapendiente" style="font-size:12px">
             <tr style="color:black !important">
             <td ><center style="margin:0px"><span class="label label-{{validarColor($requerimiento->prioridad_requerimiento)}}">{{validarLista($requerimiento->prioridad_requerimiento,2)}}</span></center></td>
             <td><center>{{validarHoras($requerimiento->tiempo_para_entrega)}}</center></td>
               <td><center>{{validarCliente($requerimiento->id_cliente)}}</center></td>
               <td><center>{{validarProducto($requerimiento->id_producto)}}</center></td>
               <td><center>{{validarUsuario($requerimiento->id_operador)}}</center></td>
               <td><a href="./editarordenf?id={{$requerimiento->id_requerimiento}}">editar</a></td>
             </tr>
          </tbody>

        </table>
      </div>
    </section>
</section>

<div class="" id="show">




</div>
</div>
</div>

<script>
document.getElementById('ver').onclick = function() {
	ele = document.getElementById("cliente").value;

	element2 = document.getElementById("show");
		url='vercliente?id='+ele;

	$("#show").load("{!!url('"+url+"')!!}");
}

</script>


@endsection
