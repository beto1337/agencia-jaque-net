
@foreach($planes as $plan)
<div class="container spark-screen">
  <div class="row">

    <form class="form"  role="form" enctype="multipart/form-data" method="POST" action="{{ url('editarplan') }}">
    {{ csrf_field() }}
    <input type="hidden" name="planid" id="planid" value="{{$plan->id_plan}}">
    <input type="hidden" name="productoantiguo" id="productoantiguo" value="{{$plan->productos}}">

<section class="col-lg-6" >
  <div class="panel panel-default" style="background-color:#605ca8">
  <div class="panel-heading" style="padding-bottom:0px;background-color:#605ca8;color:white">
  <center><label  style="padding:1px;text-shadow: black 0.1em 0.1em 0.2em;font-family:'Baloo Bhaina';font-size:16px" >INFORMACION DEL PLAN</label></center></div>
<div class="panel-body" style="text-shadow: black 0.1em 0.1em 0.2em;background-color:#b0c4de;color:white;padding-top:0px;padding-bottom:5px;margin:2px;border-top-color:red">


    <section class="col-lg-12" >
      <div class="form-group" style="padding-top:10px">
        <h6 style="margin:0px"><label>NOMBRE</label></h6>
        <input type="text" class="form-control" id="ejemplo_email_1" name="nombre"
              value="{{$plan->nombre_plan}}">
      </div>
      <div class="form-group" style="padding-top:10px">
        <h6 style="margin:0px"><label>DESCRIPCION</label></h6>
        <textarea type="text" class="form-control" id="ejemplo_email_1" name="descripcion"
               placeholder="">{{$plan->descripcion_plan}}</textarea>
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
    <div class="form-group">
      <h6 style="margin:0px;text-shadow: black 0.1em 0.1em 0.2em;"><label>PRODUCTOS</label></h6>
      <h6 style="margin-top:0px;color:black">{{validarproductosplan($plan->productos)}}</h6>
    </div>
        <select class="form-control selectproducto select2 select2-hidden-accessible " multiple="" data-placeholder="" style="width:100%" tabindex="-1" aria-hidden="true" id="productos" name="productos[]">
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
          <button type="submit" style="width:100%" class="myButton">EDITAR PLAN</button>
          {{validarclienterequerimiento($plan->id_plan,3)}}
        </div>
      </div>
    </section>
  </form>
  </div>
  </div>
  @endforeach



<script>
$(function () {
    $(".selectproducto").select2();
});


</script>
