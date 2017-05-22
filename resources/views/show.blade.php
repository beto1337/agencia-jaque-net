@extends('layouts.app')

@section('htmlheader_title')
  ORDEN
@endsection
@section('main-content')
@if(Session::has('flash_message_noacepta'))
<div class="alert alert-danger alert-dismissable fade in">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>importante! </strong> {{Session::get('flash_message_noacepta')}}
</div>
@endif

<div class="row">
  <section class="col-lg-7">
    <label for="">ORDEN DE TRABAJO Nº {{$_GET['id']}}</label>
  </section>
  <section class="col-lg-6 col-md-offset-0" >
    <div class="panel panel-default">
      <div class="panel-heading">Informacion De La Orden
      </div>
        <div class="panel-body">
          <div class="table-responsive">
            <table class="table" id="show2">
              @include('layouts.partials.tablashow')
            </table>
          </div>
        </div>
    </div>
  </section>
@foreach($requerimiento as $requerimiento)
@if($requerimiento->id_operador==Auth::user()->id)
@if ($requerimiento->estado_requerimiento==2 or $requerimiento->estado_requerimiento==3)
<form role="form" enctype="multipart/form-data" method="POST" action="{{ url('show/process') }}">
  {{ csrf_field() }}
 <section class="col-lg-5" style="min-height:430px;">
   <label style="width:100%">ADJUNTAR TRABAJO REALIZADO</label>
   <input id="input-700"  name="kartik-input-700[]" type="file" multiple class="file-loading">
  <div class="form-group">
     <label class="control-label" >Link</label>
     <input type="text" class="form-control"  id="link" name="link" placeholder="facebook.com,agenciajaque.com,pinterest.com" >
     <fieldset id="buildyourform">
  </fieldset>
  <label>necesitas Agregar otro link?</label>
  <input type="button" value="+" class="add btn btn-primary btn-xs" id="add" />


   </div>
   <div class="form-group">
     <label class="control-label" >comentario</label>
      <textarea type="text" name="comentario" class="form-control"></textarea>
   </div>

   <input type="hidden" name="id_requerimiento" value="{{$requerimiento->id_requerimiento}}">
   <input type="hidden" name="estado_requerimiento" value="{{$requerimiento->estado_requerimiento}}">

 </br>

 </br>
 </section>

<section class="col-lg-6 col-md-offset-0">
  <div style="width:100%">
   @if($requerimiento->estado_requerimiento==2)
   <button type="submit" style="width:49%;" name="aceptar" class="btn btn-danger">PARAR</button>
   <button type="submit" style="width:49%;" name="terminar" class="btn btn-success"  >TERMINAR</button>

   @endif
   @if($requerimiento->estado_requerimiento==3)
   <button type="submit" style="width:50%" name="aceptar" class="btn btn-info">RETOMAR</button>
   <button type="submit" style="width:49%;" name="terminar" class="btn btn-success"  >TERMINAR</button>
   @endif
 </div>
</section>
</form>
@endif

@if ($requerimiento->estado_requerimiento < 2 or $requerimiento->estado_requerimiento > 3)
<section class="col-lg-5">
<div id='content2' class="col-lg-12" >
<form role="form" enctype="multipart/form-data" method="POST" action="{{ url('show/process') }}">
{{ csrf_field() }}
<input type="hidden" name="id_requerimiento" value="{{$requerimiento->id_requerimiento}}">
<input type="hidden" name="estado_requerimiento" value="{{$requerimiento->estado_requerimiento}}">
{{validarAccion($requerimiento->estado_requerimiento, $requerimiento->id_operador,1,$_GET['id'])}}
</br>
<div class="panel panel-default" style="display:none;" id="content">

<div class="panel-heading">Detalle de la devolucion</div>
<div class="panel-body">
  <label for="ejemplo_email_1">Descripcion De La Devolucion</label>
  <textarea type="text" class="form-control" rows="3" id="comentario" name="comentario"
         placeholder="Razon Por la que devuelve el trabajo"></textarea >

  <input type="hidden" name="id_requerimiento" value="{{$requerimiento->id_requerimiento}}">
  <input type="hidden" name="estado_requerimiento" value="{{$requerimiento->estado_requerimiento}}"><br>

  <center><button type="submit" class="btn btn-default" style="margin:5px" name="revision" id="revision">ENVIAR A REVISION</button></center>
</div>
</div>

</form>
</div>


</section>
@endif
<script>

function showContent() {
    element = document.getElementById("content");
    element2 = document.getElementById("aceptar");
    check = document.getElementById("check");
    if (check.checked) {
        element.style.display='block';
        element2.style.display='none';
    }
    else {
        element.style.display='none';
        element2.style.display='block';
    }
}
    $(document).ready(function() {
  $("#add").click(function() {
      var intId = $("#buildyourform div").length + 1;
      if (intId>5) {
        var fieldWrapper = $("<div style=\" padding-top:5px\"  class=\"fieldwrapper\" id=\"field" + intId + "\"/>");
        var flink = $("<input type=\"text\" style=\"width:94%\" class=\"fieldname col-lg-9 form-control\" name=\"link" + intId + "\"/>");
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
        var flink = $("<input type=\"text\" style=\"width:94%\" class=\"fieldname col-lg-9 form-control\" name=\"link" + intId + "\"/>");
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
@endif

@if($requerimiento->id_usuario==Auth::user()->id and $requerimiento->aprobadopor!=Auth::user()->id)
<section class="col-lg-5">
<div id='content2' class="col-lg-12" >
<form role="form" enctype="multipart/form-data" method="POST" action="{{ url('show/process') }}">
{{ csrf_field() }}
<input type="hidden" name="id_requerimiento" value="{{$requerimiento->id_requerimiento}}">
<input type="hidden" name="estado_requerimiento" value="{{$requerimiento->estado_requerimiento}}">
{{validarAccion($requerimiento->estado_requerimiento, $requerimiento->id_usuario,2,$_GET['id'])}}
</br>

</form>
</div>
</section> 
@endif

@if($requerimiento->aprobadopor==Auth::user()->id and $requerimiento->id_usuario!=Auth::user()->id)
<section class="col-lg-5">
<div id='content2' class="col-lg-12" >
<form role="form" enctype="multipart/form-data" method="POST" action="{{ url('show/process') }}">
{{ csrf_field() }}
<input type="hidden" name="id_requerimiento" value="{{$requerimiento->id_requerimiento}}">
<input type="hidden" name="estado_requerimiento" value="{{$requerimiento->estado_requerimiento}}">
{{validarAccion($requerimiento->estado_requerimiento, $requerimiento->id_usuario,3,$_GET['id'])}}
</br>
</form>
</div>
</section>
@endif

@if($requerimiento->aprobadopor==Auth::user()->id and $requerimiento->id_usuario==Auth::user()->id)
<section class="col-lg-5">
<div id='content2' class="col-lg-12" >
<form role="form" enctype="multipart/form-data" method="POST" action="{{ url('show/process') }}">
{{ csrf_field() }}
<input type="hidden" name="id_requerimiento" value="{{$requerimiento->id_requerimiento}}">
<input type="hidden" name="estado_requerimiento" value="{{$requerimiento->estado_requerimiento}}">
{{validarAccion($requerimiento->estado_requerimiento, $requerimiento->id_usuario,4,$_GET['id'])}}
</br>
</form>
</div>
</section>
@endif
@endforeach
</div>
@endsection
