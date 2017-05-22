
@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection
@section('main-content')

<div class="container spark-screen">
  <div class="row">


<form class="form-horizontal"  role="form" enctype="multipart/form-data" method="POST" action="{{ url('registrar-producto') }}">
{{ csrf_field() }}
  <div class="form-group">
    <label for="ejemplo_email_3" class="col-lg-2 control-label">Nombre Del Producto</label>
    <div class="col-lg-3">
      <input type="text" class="form-control col-lg-5" name="nombreproducto" placeholder="nombre del producto">
    </div>
  </div>
  <div class="form-group">
	  <label for="ejemplo_password_3" class="col-lg-2 control-label">Descripciòn</label>
			<div class="col-lg-3">
    <input type="text" class="form-control col-lg-5" name="descripcion" placeholder="descripcion">  </div>
</div>
  <div class="form-group">
		    <label for="ejemplo_password_3" class="col-lg-2 control-label">Redes Asociadas</label>
<div class="">


    <label class="checkbox-inline control-label">
    <input type="checkbox" id="checkboxEnLinea1" name="facebook" ><i class='fa fa-facebook'></i>
  </label>
	<label class="checkbox-inline control-label">
	<input type="checkbox" id="checkboxEnLinea1"  name="twitter"><i class='fa  fa-twitter'></i>
</label>
<label class="checkbox-inline control-label">
<input type="checkbox" id="checkboxEnLinea1" name="instagram"><i class='fa fa-instagram'></i>
</label>
  <label class="checkbox-inline">
    <input type="checkbox" id="checkboxEnLinea2"  name="google+"><i class='fa  fa-google-plus'></i>
  </label>
	<label class="checkbox-inline control-label">
	<input type="checkbox" id="checkboxEnLinea1" name="pinterest"><i class='fa fa-pinterest-p'></i>
</label>
<label class="checkbox-inline control-label">
<input type="checkbox" id="checkboxEnLinea1"  name="brand">Brand
</label>
</div>
    </div>



		<div class="form-group">
	    <label for="ejemplo_email_3" class="col-lg-2 control-label">Codec</label>
	    <div class="col-lg-3">
	      <input type="text" class="form-control col-lg-5" name="codec" placeholder="MP4">
	    </div>
	  </div>
		<div class="form-group">
	    <label for="ejemplo_email_3" class="col-lg-2 control-label">Tamaño</label>
	    <div class="col-lg-3">
	      <input type="text" class="form-control col-lg-5" name="tamano" placeholder="20MB">
	    </div>
	  </div>
		<div class="form-group">
	    <label for="ejemplo_email_3" class="col-lg-2 control-label">Resolucion</label>
	    <div class="col-lg-3">
	      <input type="text" class="form-control col-lg-5" name="resolucion" placeholder="1024x720">
	    </div>
	  </div>

	<div class="form-group">
<label class="col-lg-2 control-label" for="ejemplo_email_1" id="producto" >Tipo de Producto</label>
    <select class="selectpicker" name="tipo_producto" id="producto_id" >
        <option value="imagen">Imagen</option>
				<option value="video">Video</option>
    </select>
  <input type="checkbox" id="checkboxEnLinea1" name="otrotipo" value="0">otro?
	<input type="text" name="otrovalor" value="" placeholder="cual?">
  </div>

	<div class="form-group">
<label class="col-lg-2 control-label" for="ejemplo_email_1"  >Division</label>
		<select class="selectpicker" name="division" id="producto_id" >
				<option value="1">Press</option>
				<option value="2">Networks</option>
				<option value="3">Comercial</option>
		</select>

	</div>

	<div class="form-group">
    <div class="col-lg-offset-2 col-lg-10">
      <button type="submit" class="btn btn-default">Enviar</button>
    </div>
  </div>

</form>

</div>
</div>
@endsection
