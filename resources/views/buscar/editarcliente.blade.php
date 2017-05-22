
<form role="form" name="formulario" id="formulario" enctype="multipart/form-data" method="POST" action="{{ url('editarcliente') }}">
{{ csrf_field() }}
@foreach($clientes as $cliente)
<section class="col-lg-6" >
  <div class="panel panel-default">
  <div class="panel-heading" style="padding-bottom:0px;background-color:#D91982;color:white">
  <center><label  style="padding:1px;text-shadow: black 0.1em 0.1em 0.2em;font-family:'Baloo Bhaina';font-size:15px" >INFORMACION PERSONAL</label></center></div>
  <div class="panel-body" style="background-color:#D8BFD8;color:white;padding-top:1px">
<input type="hidden" name="id_cliente" id="clienteid" value="{{$cliente->id_cliente}}">
<input type="hidden" name="planantiguo" id="planantiguo" value="{{$cliente->id_plan}}">
<section class="col-lg-6" >

  @if($cliente->alias=="")
  @else
  <div class="form-group" style="padding-top:10px">
    <h6 style="margin:0px;text-shadow: black 0.1em 0.1em 0.2em;"><label>ALIAS</label></h6>
    <p  class="help-block" name="alias" style="background-color:#D8BFD8;color:black" >{{$cliente->alias}}</p>
  </div>

  @endif
  <div class="form-group" style="padding-top:10px">
    <h6 style="margin:0px;text-shadow: black 0.1em 0.1em 0.2em;"><label>ALIAS</label></h6>
    <input  class="form-control" name="alias" style="color:black" value="{{$cliente->alias}}"></input>
  </div>

    <div class="form-group" style="padding-top:10px">
      <h6 style="margin:0px;text-shadow: black 0.1em 0.1em 0.2em;"><label>NOMBRES</label></h6>
      <input  class="form-control" name="nombre_cl" style=" color:black" value="{{$cliente->nombre_cliente}}">
    </div>

  <div class="form-group">
  <h6 style="margin:0px;text-shadow: black 0.1em 0.1em 0.2em;"><label>APELLIDOS</label></h6>
  <input  class="form-control" name="apellido_cl" style=" color:black" value="{{$cliente->apellido_cliente}}">
  </div>

    <div class="form-group">
      <h6 style="margin:0px;text-shadow: black 0.1em 0.1em 0.2em;"><label>CORREO</label></h6>
      <input  class="form-control" name="correo_cl" style=" color:black" value="{{$cliente->correo_cliente}}">
    </div>

    <div class="form-group">
       <h6 style="margin:0px;text-shadow: black 0.1em 0.1em 0.2em;"><label>TELÉFONO FIJO </label></h6>
      <input  class="form-control" name="telefono_cl" style=" color:black" value="{{$cliente->telefono_cliente}}">
    </div>

    <div class="form-group">
       <h6 style="margin:0px;text-shadow: black 0.1em 0.1em 0.2em;"><label>CELULAR </label></h6>
       <input  class="form-control" name="celular_cl" style=" color:black" value="{{$cliente->celular}}">
    </div>

    <div class="form-group">
       <h6 style="margin:0px;text-shadow: black 0.1em 0.1em 0.2em;"><label>WHATSAPP </label></h6>
       <input  class="form-control" name="whatsapp_cl" style=" color:black" value="{{$cliente->whatsapp}}">
    </div>


</section>

<section class="col-lg-6">



<section class="col-lg-12" style="padding:5px;margin:0">
<div class="form-group" style="padding:0;margin:0">
<div class="col-lg-1" style="margin-left:-10px;margin-right:15px">
<img class="" src="https://s3-us-west-2.amazonaws.com/agencia-jaque/gestion/fb-300.png"  style="width:34px" alt="">
</div>
<div class="col-lg-10" style="padding-right:5px;padding-left:15px" >
<input  class="form-control" name="facebook" style="color:black" value="{{$cliente->facebook}}">
</div>
</div>
</section>

<section class="col-lg-12" style="padding:5px;margin:0">
<div class="form-group" style="padding:0;margin:0">
<div class="col-lg-1" style="margin-left:-10px;margin-right:15px">
<img class="" src="https://s3-us-west-2.amazonaws.com/agencia-jaque/gestion/twitter-300.png"  style="width:34px" alt="">
</div>
<div class="col-lg-10" style="padding-right:5px;padding-left:15px" >
  <input  class="form-control" name="twitter" style=" color:black" value="{{$cliente->twitter}}">
</div>
</div>
</section>

<section class="col-lg-12" style="padding:5px;margin:0">
<div class="form-group" style="padding:0;margin:0">
<div class="col-lg-1" style="margin-left:-10px;margin-right:15px">
<img class="" src="https://s3-us-west-2.amazonaws.com/agencia-jaque/gestion/instagram-300.png"  style="width:34px" alt="">
</div>
<div class="col-lg-10" style="padding-right:5px;padding-left:15px" >
  <input  class="form-control" name="instagram" style=" color:black" value="{{$cliente->instagram}}">
</div>
</div>
</section>

<section class="col-lg-12" style="padding:5px;margin:0">
<div class="form-group" style="padding:0;margin:0">
<div class="col-lg-1" style="margin-left:-10px;margin-right:15px">
<img class="" src="https://s3-us-west-2.amazonaws.com/agencia-jaque/gestion/pinterest-300.png"  style="width:34px" alt="">
</div>
<div class="col-lg-10" style="padding-right:5px;padding-left:15px" >
<input  class="form-control" name="pinterest" style=" color:black" value="{{$cliente->pinterest}}">

</div>
</div>
</section>

<section class="col-lg-12" style="padding:5px;margin:0">
<div class="form-group" style="padding:0;margin:0">
<div class="col-lg-1" style="margin-left:-10px;margin-right:15px">
<img class="" src="https://s3-us-west-2.amazonaws.com/agencia-jaque/gestion/google-3000.png"  style="width:34px" alt="">
</div>
<div class="col-lg-10" style="padding-right:5px;padding-left:15px" >
<h6 style="margin-top:0px;color:black"></h6>
<input  class="form-control" name="googleplus" style=" color:black" value="{{$cliente->googleplus}}">
</div>
</div>
</section>

<section class="col-lg-12" style="padding:5px;margin:0">
<div class="form-group" style="padding:0;margin:0">
<div class="col-lg-1" style="margin-left:-10px;margin-right:15px">
<img class="" src="https://s3-us-west-2.amazonaws.com/agencia-jaque/gestion/youtube-300.png"  style="width:34px" alt="">
</div>
<div class="col-lg-10" style="padding-right:5px;padding-left:15px" >
  <input  class="form-control" name="youtube" style=" color:black" value="{{$cliente->youtube}}">
</div>
</div>
</section>



</section>
</div>
</div>
</section>
<section class="col-lg-3">
  <div class="panel panel-default">
  <div class="panel-heading" style="padding-bottom:0px;background-color:#605ca8;color:white">
  <center><label  style="padding:1px;text-shadow: black 0.1em 0.1em 0.2em;font-family:'Baloo Bhaina';font-size:18px" >INFORMACION DE CONTACTO</label></center></div>
  <div class="panel-body" style="background-color:#b0c4de;color:white;padding-top:1px">

    <div class="form-group" style="padding-top:10px">
      <h6 style="margin:0px;text-shadow: black 0.1em 0.1em 0.2em;;text-shadow: black 0.1em 0.1em 0.2em;"><label>NOMBRES</label></h6>
      <input  class="form-control" name="nombre_co" style="color:black" value="{{$cliente->nombre_contacto}}">
    </div>

    <div class="form-group">
      <h6 style="margin:0px;text-shadow: black 0.1em 0.1em 0.2em;;text-shadow: black 0.1em 0.1em 0.2em;"><label>APELLIDOS</label></h6>
      <input  class="form-control" name="apellido_co" style=" color:black" value="{{$cliente->apellido_contacto}}">
    </div>

    <div class="form-group">
      <h6 style="margin:0px;text-shadow: black 0.1em 0.1em 0.2em;;text-shadow: black 0.1em 0.1em 0.2em;"><label>CORREO</label></h6>
      <input  class="form-control" name="correo_co" style=" color:black" value="{{$cliente->correo_contacto}}">
    </div>

    <div class="form-group">
       <h6 style="margin:0px;text-shadow: black 0.1em 0.1em 0.2em;;text-shadow: black 0.1em 0.1em 0.2em;"><label>TELÉFONO FIJO </label></h6>
       <input  class="form-control" name="telefono_co" style=" color:black" value="{{$cliente->telefono_contacto}}">
    </div>

    <div class="form-group">
       <h6 style="margin:0px;text-shadow: black 0.1em 0.1em 0.2em;;text-shadow: black 0.1em 0.1em 0.2em;"><label>CELULAR </label></h6>
      <input  class="form-control" name="celular_co" style=" color:black" value="{{$cliente->celular_contacto}}">
    </div>

    <div class="form-group">
       <h6 style="margin:0px;text-shadow: black 0.1em 0.1em 0.2em;;text-shadow: black 0.1em 0.1em 0.2em;"><label>WHATSAPP </label></h6>
    <h6 style="margin-top:0px;color:black"></h6>
    <input  class="form-control" name="whatsapp_co" style=" color:black" value="{{$cliente->whatsapp_contacto}}">
    </div>

</div>
</div>
</section>



<section class="col-lg-3">
  <div class="panel panel-default">
  <div class="panel-heading" style="padding-bottom:0px;background-color:#605ca8;color:white">
  <center><label  style="padding:1px;text-shadow: black 0.1em 0.1em 0.2em;font-family:'Baloo Bhaina';font-size:18px" >PLANES</label></center></div>
  <div class="panel-body" style="background-color:#b0c4de;color:white;padding:22px">

    <section class="col-lg-12" style="padding:0px;padding-right:0px">

<h6 style="margin-top:0px;color:black">{{validarplan($cliente->id_plan)}}</h6>
  </section>

      <div class="col-sm-12" style="background-color:#b0c4de;padding:8px;border-radius:0px 5px 5px 0px; border: 2px solid #605ca8;">

<select class="form-control select2 selectplan select2-hidden-accessible " multiple style="width:100%" id="planes" name="planes[]">
  			@foreach($planes as $planes)
  			<option value="{{ $planes->id_plan }}">{{$planes->nombre_plan}}</option>
  			@endforeach
  			</select>
      </div>


  </div>
  </div>


  <div class="form-group">
   <div style="padding-top:10px" >
     <button  id="editarcl" name="editarcl" style="width:100%" class="myButton">EDITAR</button>
     {{validarclienterequerimiento($cliente->id_cliente,1)}}
   </div>
   </div>
</section>


</form>

@endforeach

<script>
$(function () {
    $(".selectplan").select2();
});


</script>
