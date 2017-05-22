@foreach($clientes as $cliente)
<section class="col-lg-6" >
  <div class="panel panel-default">
  <div class="panel-heading" style="padding-bottom:0px;background-color:#D91982;color:white">
  <center><label  style="padding:1px;text-shadow: black 0.1em 0.1em 0.2em;font-family:'Baloo Bhaina';font-size:15px" >INFORMACION PERSONAL</label></center></div>
  <div class="panel-body" style="background-color:#D8BFD8;color:white;padding-top:1px">

<section class="col-lg-6" >

<div class="form-group" style="padding-top:10px">
  <h6 style="margin:0px;text-shadow: black 0.1em 0.1em 0.2em;"><label>NOMBRE ARTISTICO</label></h6>
  <h6 style="margin-top:0px;color:black">{{$cliente->alias}}</h6>
</div>

    <div class="form-group" style="padding-top:10px">
      <h6 style="margin:0px;text-shadow: black 0.1em 0.1em 0.2em;"><label>NOMBRES</label></h6>
      <h6 style="margin-top:0px;color:black">{{$cliente->nombre_cliente}}</h6>
    </div>

    <div class="form-group">
      <h6 style="margin:0px;text-shadow: black 0.1em 0.1em 0.2em;"><label>APELLIDOS</label></h6>
      <h6 style="margin-top:0px;color:black">{{$cliente->apellido_cliente}}</h6>
    </div>

    <div class="form-group">
      <h6 style="margin:0px;text-shadow: black 0.1em 0.1em 0.2em;"><label>CORREO</label></h6>
      <h6 style="margin-top:0px;color:black">{{$cliente->correo_cliente}}</h6>
    </div>

    <div class="form-group">
       <h6 style="margin:0px;text-shadow: black 0.1em 0.1em 0.2em;"><label>TELÉFONO FIJO </label></h6>
      <h6 style="margin-top:0px;color:black">{{$cliente->telefono_cliente}}</h6>
    </div>
    <div class="form-group">
       <h6 style="margin:0px;text-shadow: black 0.1em 0.1em 0.2em;"><label>CELULAR </label></h6>
    <h6 style="margin-top:0px;color:black">{{$cliente->celular}}</h6>
    </div>
    <div class="form-group">
       <h6 style="margin:0px;text-shadow: black 0.1em 0.1em 0.2em;"><label>WHATSAPP </label></h6>
      <h6 style="margin-top:0px;color:black">{{$cliente->whatsapp}}</h6>
    </div>


</section>

<section class="col-lg-6">



<section class="col-lg-12" style="padding:5px;margin:0">
<div class="form-group" style="padding:0;margin:0">
<div class="col-lg-1" style="margin-left:-10px;margin-right:15px">
<img class="" src="https://s3-us-west-2.amazonaws.com/agencia-jaque/gestion/fb-300.png"  style="width:34px" alt="">
</div>
<div class="col-lg-10" style="padding-right:5px;padding-left:15px" >
<h6 style="margin-top:0px;color:black">{{$cliente->facebook}}</h6>
</div>
</div>
</section>

<section class="col-lg-12" style="padding:5px;margin:0">
<div class="form-group" style="padding:0;margin:0">
<div class="col-lg-1" style="margin-left:-10px;margin-right:15px">
<img class="" src="https://s3-us-west-2.amazonaws.com/agencia-jaque/gestion/twitter-300.png"  style="width:34px" alt="">
</div>
<div class="col-lg-10" style="padding-right:5px;padding-left:15px" >
<h6 style="margin-top:0px;color:black">{{$cliente->twitter}}</h6>
</div>
</div>
</section>

<section class="col-lg-12" style="padding:5px;margin:0">
<div class="form-group" style="padding:0;margin:0">
<div class="col-lg-1" style="margin-left:-10px;margin-right:15px">
<img class="" src="https://s3-us-west-2.amazonaws.com/agencia-jaque/gestion/instagram-300.png"  style="width:34px" alt="">
</div>
<div class="col-lg-10" style="padding-right:5px;padding-left:15px" >
<h6 style="margin-top:0px;color:black">{{$cliente->instagram}}</h6>
</div>
</div>
</section>

<section class="col-lg-12" style="padding:5px;margin:0">
<div class="form-group" style="padding:0;margin:0">
<div class="col-lg-1" style="margin-left:-10px;margin-right:15px">
<img class="" src="https://s3-us-west-2.amazonaws.com/agencia-jaque/gestion/pinterest-300.png"  style="width:34px" alt="">
</div>
<div class="col-lg-10" style="padding-right:5px;padding-left:15px" >
<h6 style="margin-top:0px;color:black">{{$cliente->pinterest}}</h6>
</div>
</div>
</section>

<section class="col-lg-12" style="padding:5px;margin:0">
<div class="form-group" style="padding:0;margin:0">
<div class="col-lg-1" style="margin-left:-10px;margin-right:15px">
<img class="" src="https://s3-us-west-2.amazonaws.com/agencia-jaque/gestion/google-3000.png"  style="width:34px" alt="">
</div>
<div class="col-lg-10" style="padding-right:5px;padding-left:15px" >
<h6 style="margin-top:0px;color:black">{{$cliente->googleplus}}</h6>
</div>
</div>
</section>

<section class="col-lg-12" style="padding:5px;margin:0">
<div class="form-group" style="padding:0;margin:0">
<div class="col-lg-1" style="margin-left:-10px;margin-right:15px">
<img class="" src="https://s3-us-west-2.amazonaws.com/agencia-jaque/gestion/youtube-300.png"  style="width:34px" alt="">
</div>
<div class="col-lg-10" style="padding-right:5px;padding-left:15px" >
<h6 style="margin-top:0px;color:black">{{$cliente->youtube}}</h6>
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
      <h6 style="margin-top:0px;margin-top:0px;color:black">{{$cliente->nombre_contacto}}</h6>
    </div>

    <div class="form-group">
      <h6 style="margin:0px;text-shadow: black 0.1em 0.1em 0.2em;;text-shadow: black 0.1em 0.1em 0.2em;"><label>APELLIDOS</label></h6>
      <h6 style="margin-top:0px;color:black">{{$cliente->apellido_contacto}}</h6>
    </div>

    <div class="form-group">
      <h6 style="margin:0px;text-shadow: black 0.1em 0.1em 0.2em;;text-shadow: black 0.1em 0.1em 0.2em;"><label>CORREO</label></h6>
      <h6 style="margin-top:0px;color:black">{{$cliente->correo_contacto}}</h6>
    </div>

    <div class="form-group">
       <h6 style="margin:0px;text-shadow: black 0.1em 0.1em 0.2em;;text-shadow: black 0.1em 0.1em 0.2em;"><label>TELÉFONO FIJO </label></h6>
      <h6 style="margin-top:0px;color:black">{{$cliente->telefono_contacto}}</h6>
    </div>

    <div class="form-group">
       <h6 style="margin:0px;text-shadow: black 0.1em 0.1em 0.2em;;text-shadow: black 0.1em 0.1em 0.2em;"><label>CELULAR </label></h6>
      <h6 style="margin-top:0px;color:black">{{$cliente->celular_contacto}}</h6>
    </div>

    <div class="form-group">
       <h6 style="margin:0px;text-shadow: black 0.1em 0.1em 0.2em;;text-shadow: black 0.1em 0.1em 0.2em;"><label>WHATSAPP </label></h6>
    <h6 style="margin-top:0px;color:black">{{$cliente->whatsapp_contacto}}</h6>
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

  </div>
  </div>

</section>
@endforeach
