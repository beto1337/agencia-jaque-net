
@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection
@section('main-content')

<div class="container spark-screen">
  <div class="row">


<form class="form"  role="form" enctype="multipart/form-data" method="POST" action="{{ url('registrar-producto') }}">
{{ csrf_field() }}

<section class="col-lg-4" >
  <div class="panel panel-default">
  <div class="panel-heading" style="padding-bottom:0px;background-color:#605ca8;color:white">
  <center><label  style="padding:1px;text-shadow: black 0.1em 0.1em 0.2em;font-family:'Baloo Bhaina';font-size:18px" >INFORMACION DEL PRODUCTO</label></center></div>
  <div class="panel-body" style="background-color:#b0c4de;color:white;text-shadow: black 0.1em 0.1em 0.2em;padding-top:1px">

    <div class="form-group" style="padding-top:10px">
      <h6 style="margin:0px"><label>NOMBRE DEL PRODUCTO</label></h6>
      <input type="text" class="form-control" id="ejemplo_email_1" name="nombreproducto"
             placeholder="">
    </div>

    <div class="form-group">
      <h6 style="margin:0px"><label>DESCRIPCION</label></h6>
      <textarea type="text" class="form-control" rows="8" id="ejemplo_password_1" name="descripcion"
             placeholder=""></textarea>
    </div>



</div>
</div>
<div class="form-group">
  <div class="col-lg-offset-2 col-lg-10">
    <button type="submit" class="myButton">REGISTRAR PRODUCTO</button>
  </div>
</div>
</section>



</form>

</div>
</div>
@endsection
