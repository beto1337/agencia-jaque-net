
@extends('layouts.app')


@section('htmlheader_title')
	REGISTRO
@endsection

@section('main-content')

<div class="container spark-screen">
  <div class="row">
		<section class="col-lg-12" style="padding:12px">
			<div class="panel panel-default" style="background-color:#605ca8">
      <div class="panel-heading" style="padding-bottom:0px;background-color:#D91982;color:white">
      <center><label  style="padding:1px;text-shadow: black 0.1em 0.1em 0.2em;font-family:'Baloo Bhaina';font-size:25px" >REGISTRAR CLIENTE</label></center></div>
</div>

		</section>
    <form class="form"  role="form" enctype="multipart/form-data" method="POST" action="{{ url('registrar-cliente') }}">
    {{ csrf_field() }}
		<section class="col-lg-3"  >

			  <div class="panel panel-default" style="background-color:#605ca8">
				<div class="panel-heading" style="padding-bottom:0px;background-color:#605ca8;color:white">
				<center><label  style="padding:1px;text-shadow: black 0.1em 0.1em 0.2em;font-family:'Baloo Bhaina';font-size:16px" >FOTO DEL CLIENTE</label></center></div>
				<div class="panel-body" style="background-color:#b0c4de;color:white;padding-top:15px;padding-bottom:5px;margin:2px;border-top-color:red">

	<input id="input-700" style="height:270px" name="kartik-input-700[]" style="min-height:417px !important" multiple type="file"  class="file-loading">

					</div>
				</div>
</section >
<section class="col-lg-6" >
	<div class="panel panel-default" style="background-color:#605ca8">
	<div class="panel-heading" style="padding-bottom:0px;background-color:#605ca8;color:white">
	<center><label  style="padding:1px;text-shadow: black 0.1em 0.1em 0.2em;font-family:'Baloo Bhaina';font-size:16px" >INFORMACION PERSONAL</label></center></div>
<div class="panel-body" style="text-shadow: black 0.1em 0.1em 0.2em;background-color:#b0c4de;color:white;padding-top:0px;padding-bottom:5px;margin:2px;border-top-color:red">


		<section class="col-lg-6" >
			<div class="form-group" style="padding-top:10px">
				<h6 style="margin:0px"><label>NOMBRE ARTISTICO</label></h6>
				<input type="text" class="form-control" id="ejemplo_email_1" name="nombreartistico_cl"
							 placeholder="">
			</div>
        <div class="form-group" style="padding-top:10px">
          <h6 style="margin:0px"><label>NOMBRES</label></h6>
          <input type="text" class="form-control" id="ejemplo_email_1" name="nombre_cl"
                 placeholder="">
        </div>

        <div class="form-group">
          <h6 style="margin:0px"><label>APELLIDOS</label></h6>
          <input type="text" class="form-control" id="ejemplo_password_1" name="apellido_cl"
                 placeholder="">
        </div>

        <div class="form-group">
          <h6 style="margin:0px"><label>CORREO</label></h6>
          <input type="email" class="form-control" id="ejemplo_email_1" name="correo_cl"
                 placeholder="">
        </div>

        <div class="form-group">
           <h6 style="margin:0px"><label>TELÉFONO FIJO </label></h6>
          <input type="number" class="form-control" id="ejemplo_password_1" name="telefono_cl"
                 placeholder="">
        </div>
        <div class="form-group">
           <h6 style="margin:0px"><label>CELULAR </label></h6>
          <input type="number" class="form-control" id="ejemplo_password_1" name="celular_cl"
                 placeholder="">
        </div>
        <div class="form-group">
           <h6 style="margin:0px"><label>WHATSAPP </label></h6>
          <input type="number" class="form-control" id="ejemplo_password_1" name="wha_cl"
                 placeholder="">
        </div>


    </section>
		<section class="col-lg-6">

    <section class="col-lg-12" style="padding:5px;margin:0">
    <div class="form-group" style="padding:0px;padding-top:22px !important;margin:0">
    <div class="col-lg-1" style="margin-left:-10px;margin-right:15px">
    <img class="" src="https://s3-us-west-2.amazonaws.com/agencia-jaque/gestion/fb-300.png"  style="width:34px" alt="">
    </div>
    <div class="col-lg-10" style="padding-right:5px;padding-left:15px" >
    <input type="text" class="form-control" name="facebook">
    </div>
    </div>
    </section>

    <section class="col-lg-12" style="padding:5px;padding-top:29px !important;margin:0">
    <div class="form-group" style="padding:0;margin:0">
    <div class="col-lg-1" style="margin-left:-10px;margin-right:15px">
    <img class="" src="https://s3-us-west-2.amazonaws.com/agencia-jaque/gestion/twitter-300.png"  style="width:34px" alt="">
    </div>
    <div class="col-lg-10" style="padding-right:5px;padding-left:15px" >
    <input type="text" class="form-control" name="twitter">
    </div>
    </div>
    </section>

    <section class="col-lg-12" style="padding:5px;padding-top:28px !important;margin:0">
    <div class="form-group" style="padding:0;margin:0">
    <div class="col-lg-1" style="margin-left:-10px;margin-right:15px">
    <img class="" src="https://s3-us-west-2.amazonaws.com/agencia-jaque/gestion/instagram-300.png"  style="width:34px" alt="">
    </div>
    <div class="col-lg-10" style="padding-right:5px;padding-left:15px" >
    <input type="text" class="form-control" name="instagram">
    </div>
    </div>
    </section>

    <section class="col-lg-12" style="padding:5px;padding-top:28px !important;margin:0">
    <div class="form-group" style="padding:0;margin:0">
    <div class="col-lg-1" style="margin-left:-10px;margin-right:15px">
    <img class="" src="https://s3-us-west-2.amazonaws.com/agencia-jaque/gestion/pinterest-300.png"  style="width:34px" alt="">
    </div>
    <div class="col-lg-10" style="padding-right:5px;padding-left:15px" >
    <input type="text" class="form-control" name="pinteres">
    </div>
    </div>
    </section>

    <section class="col-lg-12" style="padding:5px;padding-top:28px !important;margin:0">
    <div class="form-group" style="padding:0;margin:0">
    <div class="col-lg-1" style="margin-left:-10px;margin-right:15px">
    <img class="" src="https://s3-us-west-2.amazonaws.com/agencia-jaque/gestion/google-3000.png"  style="width:34px" alt="">
    </div>
    <div class="col-lg-10" style="padding-right:5px;padding-left:15px" >
    <input type="text" class="form-control" name="google">
    </div>
    </div>
    </section>

    <section class="col-lg-12" style="padding:5px;padding-top:28px !important;margin:0">
    <div class="form-group" style="padding:10;margin:0">
    <div class="col-lg-1" style="margin-left:-10px;margin-right:15px">
    <img class="" src="https://s3-us-west-2.amazonaws.com/agencia-jaque/gestion/youtube-300.png"  style="width:34px" alt="">
    </div>
    <div class="col-lg-10" style="padding-right:5px;padding-left:15px" >
    <input type="text" class="form-control" name="youtube">
    </div>
    </div>
    </section>

    </section>
	</div>
	</div>
  </section>


    <section class="col-lg-3">
      <div class="panel panel-default" style="background-color:#605ca8">
      <div class="panel-heading" style="padding-bottom:0px;background-color:#605ca8;color:white">
      <center><label  style="padding:1px;text-shadow: black 0.1em 0.1em 0.2em;font-family:'Baloo Bhaina';font-size:16px">CONTACTO</label></center></div>
      <div class="panel-body" style="text-shadow: black 0.1em 0.1em 0.2em;background-color:#b0c4de;color:white;padding-top:0px;padding-bottom:5px;margin:2px;border-top-color:red">
        <div class="form-group" style="padding-top:10px">
          <h6 style="margin:0px"><label>NOMBRES</label></h6>
          <input type="text" class="form-control" id="ejemplo_email_1" name="nombre_co"
                 placeholder="">
        </div>

        <div class="form-group">
          <h6 style="margin:0px"><label>APELLIDOS</label></h6>
          <input type="text" class="form-control" id="ejemplo_password_1" name="apellido_co"
                 placeholder="">
        </div>

        <div class="form-group">
          <h6 style="margin:0px"><label>CORREO</label></h6>
          <input type="email" class="form-control" id="ejemplo_email_1" name="correo_co"
                 placeholder="">
        </div>

        <div class="form-group">
           <h6 style="margin:0px"><label>TELÉFONO FIJO </label></h6>
          <input type="number" class="form-control" id="ejemplo_password_1" name="telefono_co"
                 placeholder="">
        </div>

        <div class="form-group">
           <h6 style="margin:0px"><label>CELULAR </label></h6>
          <input type="number" class="form-control" id="ejemplo_password_1" name="celular_co"
                 placeholder="">
        </div>

        <div class="form-group">
           <h6 style="margin:0px"><label>WHATSAPP </label></h6>
          <input type="number" class="form-control" id="ejemplo_password_1" name="wha_co"
                 placeholder="">
        </div>

    </div>
    </div>
    </section>






	<section class="col-lg-9">
		<div class="col-sm-3" style="background-color:#605ca8;border-radius:5px 0px 0px 5px;">
<center style="background-color:#605ca8;color:white;padding:12px;padding-top:14px !important;" ><label  style="text-shadow: black 0.1em 0.1em 0.2em;font-family:'Baloo Bhaina';font-size:16px;top:16px" >PLANES</label></center>
    </div>
    <div class="col-sm-9" style="background-color:#b0c4de;padding:8px;border-radius:0px 5px 5px 0px; border: 2px solid #605ca8;">
			<select class="form-control select2 select2-hidden-accessible " multiple="" data-placeholder="" style="width:100%" tabindex="-1" aria-hidden="true" id="planes" name="planes[]">
			@foreach($planes as $planes)
			<option value="{{ $planes->id_plan }}">{{$planes->nombre_plan}}</option>
			@endforeach
			</select>
    </div>
		</section>
		<section class="col-lg-3" style="padding:12px">

			<div class="form-group" style="padding:0px">
				<div class="col-lg-12" style="padding:0px;">
					<button type="submit" style="width:100%" class="myButton">REGISTRAR CLIENTE</button>
				</div>
			</div>
		</section>
  </form>
  </div>
  </div>

@endsection
