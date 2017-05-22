@extends('layouts.app')

@section('htmlheader_title')
	perfil
@endsection
@section('main-content')

<div class="container spark-screen">
<div class="row">


	<section class="col-lg-10" style="padding:12px">
		<div class="panel panel-default" style="background-color:#605ca8">
		<div class="panel-heading" style="padding:0px;background-color:#D91982;color:white">
		<center><label class="labeltitle" id="titulo" >REGISTRAR ORDEN</label></center></div>
</div>

	</section>
  <form role="form" enctype="multipart/form-data" method="POST" action="{{ url('enviar-pedido') }}">
  {{ csrf_field() }}
<section class="col-lg-5" >
	<div class="panel panel-default" style="background-color:#605ca8">
	<div class="panel-heading" style="padding-bottom:0px;background-color:#605ca8;color:white">
	<center><label  style="padding:1px;text-shadow: black 0.1em 0.1em 0.2em;font-size:15px" >ORDEN DE TRABAJO</label></center></div>
	<div class="panel-body" style="background-color:#b0c4de;color:white;padding-top:15px;padding-bottom:5px;margin:2px;border-top-color:red">
	<center>
  <div class="form-group">
    <label style="text-shadow: black 0.1em 0.1em 0.2em" for="ejemplo_email_1">DETALLES DE LA ORDEN</label>
    <textarea type="text" class="form-control" rows="3" id="nota_pedido" name="nota_pedido"
           placeholder="ingrese los detalles de su pedido">{{old('nota_pedido') }}</textarea >
  </div>
  <div class="form-group col-lg-12" style="padding:0px;margin-bottom:0px">

    <label style="text-shadow: black 0.1em 0.1em 0.2em" for="ejemplo_email_1" id="cliente" name="cliente">CLIENTE</label>
    <select class="form-control select2 select2-hidden-accessible" name="Cliente" id="cliente">
<option  value="{{old('Cliente') }}"> {{validarcliente(old('Cliente')) }}</option>
			@foreach($clientes as $cliente)
        <option value="{{ $cliente->id_cliente }}">{{$cliente->alias}}</option>
      @endforeach
    </select>
		@if ($errors->has('Cliente') )
		<p style="color:red;margin:0px">{{ $errors->first('Cliente') }}</p>
		@endif
  </div>
  <div class="form-group col-lg-12" style="padding:0px;padding-top:5px;margin-bottom:0px">
  <label style="text-shadow: black 0.1em 0.1em 0.2em" for="ejemplo_email_1" id="producto" name="producto">PRODUCTO </label>
	<select   class="form-control select2 select2-hidden-accessible " id="producto" name="Producto">
 <option  value="{{old('Producto') }}"> {{validarproducto(old('Producto')) }}</option>
		  @foreach($productos as $producto)
        <option value="{{$producto->id_producto}}">{{$producto->nombre_producto}}</option>
      @endforeach
    </select>
		@if ($errors->has('Producto') )
		<p style="color:red;margin:0px">{{ $errors->first('Producto') }}</p>
		@endif
  </div>

  <div class="form-group col-lg-12" style="padding:0px;padding-top:5px;margin-bottom:0px">
			<label for="ejemplo_email_1" id="producto" name="producto" style="text-shadow: black 0.1em 0.1em 0.2em">OPERADOR </label>
  <select   class="form-control select2 select2-hidden-accessible "data-placeholder="" style="background-color:#605ca8;border-radius:2px" tabindex="-1" aria-hidden="true" id="cliente" name="Operador">
 <option  value="{{old('Operador') }}"> {{validarUsuario(old('Operador')) }}</option>
  @foreach($users as $user)
	@if($user->id!=Auth::user()->id )
  <option value="{{ $user->id }}">{{strtoupper($user->name)}}</option>
	@endif
  @endforeach
  </select>
	@if ($errors->has('Operador') )
	<p style="color:red;margin:0px">{{ $errors->first('Operador') }}</p>
	@endif
  </div>
  <div class="form-group col-lg-12" style="padding:0px;padding-top:5px;margin-bottom:0px">
	<label for="ejemplo_email_1" id="producto" name="producto" style="text-shadow: black 0.1em 0.1em 0.2em">APROBADO POR </label>
	<select   class="form-control select2 select2-hidden-accessible "data-placeholder="" style="background-color:#605ca8;border-radius:2px" tabindex="-1" aria-hidden="true" id="cliente" name="Aprobado_por">
<option value="{{old('Aprobado_por') }}">{{validarUsuario(old('Aprobado_por')) }}</option>
	@foreach($users as $user)
	@if($user->id_perfil==1 or $user->id_perfil==2)
	<option value="{{ $user->id }}">{{strtoupper($user->name)}}</option>
	@endif
	@endforeach
	</select>
	@if ($errors->has('Aprobado_por') )
	<p style="color:red;margin:0px">{{ $errors->first('Aprobado_por') }}</p>
	@endif
	</div>
</center>
	 <div class="form-group">
<div class="col-lg-6" style="padding-left:0;top:10px">
<label style="text-shadow: black 0.1em 0.1em 0.2em" for="ejemplo_email_1"  >FECHA LIMITE DE ENTEGA</label>
</div>

	   <div class='input-group date class="col-lg-6' id='datetimepicker1' style="top:5px !important;color:black !important">

	  <input type='text' class="form-control" name="Fecha_limite_de_entrega"  value="{{old('Fecha_limite_de_entrega')}}" />
	<span class="input-group-addon">
	 <span class="glyphicon glyphicon-calendar">
	       </span>
	    </span>
	  </div>
		@if ($errors->has('Fecha_limite_de_entrega') )
		<center><p style="color:red;margin-top:2px">{{ $errors->first('Fecha_limite_de_entrega') }}</p></center>
		@endif

</div>


  <div class="form-group">
  <label class="checkbox-inline control-label">
  <input type="checkbox" id="check" value="1" name="anterior" onchange="javascript:showContent()">Crear orden con fecha anterior
  </label>
	<div id="content" style="display: none;" >
		<div class="col-lg-6" style="padding-left:0;top:6px">
			<label style="text-shadow: black 0.1em 0.1em 0.2em" for="ejemplo_email_1">FECHA DE ORDEN</label>
		</div>

		<div class='input-group date col-lg-6' style="color:black !important">
	 <input type='text' class="form-control" name="Fecha_de_orden" id='datetimepicker2'  value="{{old('Fecha_de_orden')}}" />
	<span class="input-group-addon">
	<span class="glyphicon glyphicon-calendar">
				</span>
		 </span>
	 </div>
	 @if ($errors->has('Fecha_de_orden') )
	 <p style="color:red;margin:0px">{{ $errors->first('Fecha_de_orden') }}</p>
	 @endif
	 </div>

  </div>
</div>
</div>
</section>
<section class="col-lg-5">
	<div class="panel panel-default" style="background-color:#605ca8">
	<div class="panel-heading" style="padding-bottom:0px;background-color:#605ca8;color:white">
	<center><label  style="padding:1px;text-shadow: black 0.1em 0.1em 0.2em;font-size:15px" >MATERIAL DE APOYO</label></center></div>
	<div class="panel-body" style="background-color:#b0c4de;color:white;padding-top:15px;padding-bottom:5px;margin:2px;border-top-color:red">


  <input id="input-700" name="kartik-input-700[]" type="file" multiple class="file-loading">
</br>
<div class="form-group">
	<label class="control-label" style="text-shadow: black 0.1em 0.1em 0.2em;">Link</label>
<input type="text" class="form-control" style="margin-top:5px" name="link" id="name1" />
	 <fieldset id="buildyourform">
</fieldset>
<label>necesitas Agregar otro link?</label>
<input type="button" value="+" class="add btn btn-primary btn-xs" id="add" />
</div>

	</div>

		</div>
		<button type="submit" class="myButton" style="WIDTH:100%;margin-top:10px">ENVIAR</button>
</section>

</form>

		</div>
	</div>
	<script>

	    function showContent() {
	        element = document.getElementById("content");
	        check = document.getElementById("check");
	        if (check.checked) {
	            element.style.display='block';
	        }
	        else {
	            element.style.display='none';
	        }
	    }

			$(document).ready(function() {
    $("#add").click(function() {
        var intId = $("#buildyourform div").length + 1;
				if (intId>5) {
					var fieldWrapper = $("<div style=\" padding-top:5px\"  class=\"fieldwrapper\" id=\"field" + intId + "\"/>");
					var flink = $("<input type=\"text\" style=\"width:95%\" class=\"fieldname col-lg-9 form-control\" name=\"link" + intId + "\"/>");
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
	        var flink = $("<input type=\"text\" style=\"width:95%\" class=\"fieldname col-lg-9 form-control\" name=\"link" + intId + "\"/>");
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
