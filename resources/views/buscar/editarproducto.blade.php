
<form role="form" name="formulario" id="formulario" enctype="multipart/form-data" method="POST" action="{{ url('editarproducto') }}">
{{ csrf_field() }}
@foreach($productos as $producto)
<input type="hidden" name="productoid" id="productoid" value="{{$producto->id_producto}}">
<section class="col-lg-6" >
  <div class="panel panel-default">
  <div class="panel-heading" style="padding-bottom:0px;background-color:#D91982;color:white">
  <center><label  style="padding:1px;text-shadow: black 0.1em 0.1em 0.2em;font-family:'Baloo Bhaina';font-size:15px" >INFORMACION DEL PRODUCTO</label></center></div>
  <div class="panel-body" style="background-color:#D8BFD8;color:white;padding-top:1px">

<section class="col-lg-12" >

<div class="form-group" style="padding-top:10px">
  <h6 style="margin:0px;text-shadow: black 0.1em 0.1em 0.2em;"><label>NOMBRE</label></h6>
  <input class="form-control" name="nombre" style="margin-top:0px;color:black" value="{{$producto->nombre_producto}}">
</div>

    <div class="form-group" style="padding-top:10px">
      <h6 style="margin:0px;text-shadow: black 0.1em 0.1em 0.2em;"><label>DESCRIPCION</label></h6>
      <textarea class="form-control" name="descripcion" style="margin-top:0px;color:black" >{{$producto->descripcion_producto}}</textarea>
    </div>


    <div class="form-group">
     <div style="padding-top:10px" >
       <button  id="editarcl" name="editarcl" style="width:100%" class="myButton">EDITAR</button>
       {{validarclienterequerimiento($producto->id_producto,2)}}
     </div>
     </div>

</section>


</div>


</section>


</form>

@endforeach

<script>
$(function () {
    $(".selectdivision").select2();
});


</script>
