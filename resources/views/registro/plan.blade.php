
@extends('layouts.app')


@section('htmlheader_title')
REGISTRO
@endsection

@section('main-content')

<div class="container spark-screen">
  <div class="row">
		<section class="col-lg-10" style="padding:12px">
			<div class="panel panel-default" style="background-color:#605ca8">
      <div class="panel-heading" style="padding-bottom:0px;background-color:#D91982;color:white">
      <center><label  style="padding:1px;text-shadow: black 0.1em 0.1em 0.2em;font-size:25px" >REGISTRAR PLAN</label></center></div>
</div>

		</section>
    <form class="form"  role="form" enctype="multipart/form-data" method="POST" action="{{ url('registrar-plan') }}">
    {{ csrf_field() }}
<section class="col-lg-6" >
	<div class="panel panel-default" style="background-color:#605ca8">
	<div class="panel-heading" style="padding-bottom:0px;background-color:#605ca8;color:white">
	<center><label  style="padding:1px;text-shadow: black 0.1em 0.1em 0.2em;font-family:'Baloo Bhaina';font-size:16px" >INFORMACION DEL PLAN</label></center></div>
<div class="panel-body" style="text-shadow: black 0.1em 0.1em 0.2em;background-color:#b0c4de;color:white;padding-top:0px;padding-bottom:5px;margin:2px;border-top-color:red">


		<section class="col-lg-12" >
			<div class="form-group" style="padding-top:10px">
				<h6 style="margin:0px"><label>NOMBRE</label></h6>
				<input type="text" class="form-control" id="ejemplo_email_1" name="nombre"
							 placeholder="">
			</div>
			<div class="form-group" style="padding-top:10px">
				<h6 style="margin:0px"><label>DESCRIPCION</label></h6>
				<textarea type="text" class="form-control" id="ejemplo_email_1" name="descripcion"
							 placeholder=""></textarea>
			</div>
    </section>

			</div>
	</div>
  </section>
	<section class="col-lg-4" >
		<div class="panel panel-default" style="background-color:#605ca8">
		<div class="panel-heading" style="padding-bottom:0px;background-color:#605ca8;color:white">
		<center><label  style="padding:1px;text-shadow: black 0.1em 0.1em 0.2em;font-family:'Baloo Bhaina';font-size:16px" >PRODUCTOS</label></center></div>
	<div class="panel-body" style="text-shadow: black 0.1em 0.1em 0.2em;background-color:#b0c4de;color:white;padding-top:5px;padding-bottom:5px;margin:2px;border-top-color:red">
					<select class="form-control select2 select2-hidden-accessible " multiple="" data-placeholder="" style="width:100%" tabindex="-1" aria-hidden="true" id="productos" name="productos[]">
					@foreach($productos as $producto)
					<option value="{{ $producto->id_producto }}">{{$producto->nombre_producto}}</option>
					@endforeach
					</select>
			</div>
		</div>
	  </section>


		<section class="col-lg-4" style="padding:12px">

			<div class="form-group" style="padding:0px">
				<div class="col-lg-12" style="padding:0px;">
					<button type="submit" style="width:100%" class="myButton">REGISTRAR PLAN</button>
				</div>
			</div>
		</section>
  </form>
  </div>
  </div>

@endsection
