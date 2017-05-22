@foreach($productos as $producto)
<section class="col-lg-6" >
  <div class="panel panel-default">
  <div class="panel-heading" style="padding-bottom:0px;background-color:#D91982;color:white">
  <center><label  style="padding:1px;text-shadow: black 0.1em 0.1em 0.2em;font-family:'Baloo Bhaina';font-size:15px" >INFORMACION DEL PRODUCTO</label></center></div>
  <div class="panel-body" style="background-color:#D8BFD8;color:white;padding-top:1px">

<section class="col-lg-12" >

<div class="form-group" style="padding-top:10px">
  <h6 style="margin:0px;text-shadow: black 0.1em 0.1em 0.2em;"><label>NOMBRE</label></h6>
  <h6 style="margin-top:0px;color:black">{{$producto->nombre_producto}}</h6>
</div>

    <div class="form-group" style="padding-top:10px">
      <h6 style="margin:0px;text-shadow: black 0.1em 0.1em 0.2em;"><label>DESCRIPCION</label></h6>
      <p style="margin-top:0px;color:black">{{$producto->descripcion_producto}}</p>
    </div>





</section>


</div>


</section>
@endforeach
