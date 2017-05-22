@extends('layouts.app')

@section('htmlheader_title')
  ORDEN
@endsection
@section('main-content')


<div class="container spark-screen">
<div class="row">
<section class="col-lg-7">
<label for="">ORDEN DE TRABAJO Nº {{$_GET['id']}}</label>
</section>
  <section class="col-lg-6 col-md-offset-0" >
    <form role="form" enctype="multipart/form-data" method="POST" action="{{ url('show/update') }}">
    {{ csrf_field() }}
    <div class="panel panel-default">
      <div class="panel-heading">Actualizar Orden</div>
      <div class="panel-body">
      <div class="table-responsive">
      <table class="table" id="show2">
        @foreach($requerimiento as $requerimiento)
        <input type="hidden" name="id_requerimiento" value="{{$requerimiento->id_requerimiento}}">
        <input type="hidden" name="id_usuario" value="{{$requerimiento->id_usuario}}">

        <tr>
        <td>REALIZADO POR :</td>
        <td>{{validarUsuario($requerimiento->id_usuario)}}</td>
        </tr>
        <tr>
        <td>ESTADO:</td>
        <td>{{validarLista($requerimiento->estado_requerimiento, 1)}}</td>
        </tr>
        <tr>
        <td>FECHA DE ENTREGA:</td>
        <td><div class='input-group date class="col-lg-6' id='datetimepicker1' style="top:1px !important;color:black !important">
       <input type='text' class="form-control" name="Fecha_limite_de_entrega"  value="{{fecha($requerimiento->fecha_limite_requerimiento)}}" >
        <span class="input-group-addon">
          <span class="glyphicon glyphicon-calendar">
        </span>
        </span>
        </div></td>
        </tr>
        <tr>
        <td>FECHA DE PEDIDO:</td>
        <td><div class='input-group date class="col-lg-6' id='datetimepicker2' style="top:1px !important;color:black !important">
       <input type='text' class="form-control" name="Fecha_de_orden"  value="{{fecha($requerimiento->fecha_requerimiento)}}" >
        <span class="input-group-addon">
          <span class="glyphicon glyphicon-calendar">
        </span>
        </span>
       </div>
      </td>
        </tr>
        <tr>
        <td>DETALLES:</td>
        <td><textarea type="text" class="form-control" name="nota" value="">{{$requerimiento->nota_requerimiento}}</textarea></td>
        </tr>
        <tr>
        <td>CLIENTE:</td>

        <td>
        <div class="form-group" style="padding:0px;margin-bottom:0px">
        <select class="form-control select2" name="Cliente" id="cliente">
        <option  value="{{$requerimiento->id_cliente}}"> {{validarCliente($requerimiento->id_cliente)}}</option>
        @foreach($clientes as $cliente)
        <option value="{{ $cliente->id_cliente }}">{{$cliente->alias}}</option>
        @endforeach
        </select>
        </div>

          </td>
        </tr>
        <tr>
        <td>PRODUCTO: </td>
        <td>  <div class="form-group" style="padding:0px;margin-bottom:0px">
          <select class="form-control select2" name="producto_id" id="producto_id" >
            <option value="{{$requerimiento->id_producto}}">{{validarProducto($requerimiento->id_producto)}}</option>
            @foreach($productos as $producto)
              <option value="{{ $producto->id_producto }}">{{$producto->nombre_producto}}</option>
            @endforeach
          </select>

            </div>
        </td>
        <tr>
        <td>APRUEBA :</td>
        <td>
          <div class="form-group col-lg-12" style="padding:0px;margin-bottom:0px">
        	<select   class="form-control select2"id="cliente" name="aprobadopor">
         <option  value="{{$requerimiento->aprobadopor}}">{{validarUsuario($requerimiento->aprobadopor)}}</option>
          @foreach($usuario as $user)
          <option value="{{ $user->id }}">{{strtoupper($user->name)}}</option>
          @endforeach
          </select>
          </div>
          </td>
        </tr>
        <tr>
        <td>OPERADOR :</td>
        <td>
          <div class="form-group col-lg-12" style="padding:0px;margin-bottom:0px">
        	<select   class="form-control select2" id="cliente" name="Operador">
         <option  value="{{$requerimiento->id_operador}}">{{validarUsuario($requerimiento->id_operador)}}</option>
          @foreach($usuario as $user)
        	@if($user->id!=Auth::user()->id )
          <option value="{{ $user->id }}">{{strtoupper($user->name)}}</option>
        	@endif
          @endforeach
          </select>
        </div>
        </td>
        </tr>

        </tr>
        <tr>
        <td>ARCHIVOS DE APOYO</td>
        <td>
              <input id="input-700" name="kartik-input-700[]" type="file" multiple class="file-loading">
              <div class="form-group">
              	<label class="control-label" style="">Link</label>
              <input type="text" class="form-control" style="margin-top:5px" name="link" id="name1" />
              	 <fieldset id="buildyourform">
              </fieldset>
              <label>necesitas Agregar otro link?</label>
              <input type="button" value="+" class="add btn btn-primary btn-xs" id="add" />
              </div>
        </td>
        </tr>
        @endforeach
      </table>
    </div>
    <button type="submit" style="width:100%" class="btn btn-default">Editar</button>
    </form>
  </div>
</div>
  </section>
  <section class="col-lg-5">
    <div class="col-lg-12">
<label for="">material de apoyo</label>
    </div>

    <?php
    $link=$requerimiento->link_adjunto_requerimiento;
    if ($link==',') {
      echo '<h5>No se cargo ningun archivo</h5>';
    }
    $links=explode(",",$link);
    $contador=count($links);
      for ($i=0; $i <$contador ; $i++) {
        if ($links[$i]=='') {
        }else{
        echo "<div class='col-lg-3' style='margin-right:5px;width:100px;'>
              <a class= style='width:100px;padding:0px' target='_blank' href='".$links[$i]."'><img style='border-radius:10%' src='".$links[$i]."' alt='' alt='' width='100px' height='60px'/></a>
              <a class='btn btn-info btn-xs'  style='width:100px;padding:0px' target='_blank' href='".$links[$i]."' ><small><STRONG>VER</strong></small></a>
              <a class='btn btn-primary btn-xs' style='width:100px;padding:0px;' href='".$links[$i]."' download='".$links[$i]."'><small><STRONG>DESCARGAR</strong></small></a>
              <a class='btn btn-danger btn-xs' style='width:100px;padding:0px;' href='./borrarimagen?link=".$links[$i]."&id=".$requerimiento->id_requerimiento."'><small><STRONG>ELIMINAR</strong></small></a>
              </div>";
      }}
    ?>

  </section>
  <script>
			$(document).ready(function() {
    $("#add").click(function() {
        var intId = $("#buildyourform div").length + 1;
				if (intId>5) {
					var fieldWrapper = $("<div style=\" padding-top:5px\"  class=\"fieldwrapper\" id=\"field" + intId + "\"/>");
					var flink = $("<input type=\"text\" style=\"width:94%\" class=\"fieldname col-lg-9 form-control\" name=\"link" + intId + "\"/>");
					var removeButton = $("<input type=\"button\" style=\"padding:5px;margin:1px;margin-left:0px;border-radius:5px;\" class=\"remove btn bg-red\" value=\"x\" />");
					removeButton.click(function() {
						$('#add').attr('disabled',false);
							$(this).parent().remove();
					});
					fieldWrapper.append(flink);
					fieldWrapper.append(removeButton);
					$("#buildyourform").append(fieldWrapper);

					$('#add').attr('disabled','disabled');
				}else {
					var fieldWrapper = $("<div style=\" padding-top:5px\"  class=\"fieldwrapper\" id=\"field" + intId + "\"/>");
	        var flink = $("<input type=\"text\" style=\"width:94%\" class=\"fieldname col-lg-9 form-control\" name=\"link" + intId + "\"/>");
	        var removeButton = $("<input type=\"button\" style=\"padding:5px;margin:1px;margin-left:0px;border-radius:5px;\" class=\"remove btn bg-red\" value=\"x\" />");
	        removeButton.click(function() {
						$('#add').attr('disabled',false);
	            $(this).parent().remove();
	        });
	        fieldWrapper.append(flink);
	        fieldWrapper.append(removeButton);
	        $("#buildyourform").append(fieldWrapper);

				}
    });

});
	</script>

@endsection
