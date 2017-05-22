@foreach($mistareas as $requerimiento)
@if ($requerimiento->id_operador==Auth::user()->id)
@if ($requerimiento->estado_requerimiento==1 or $requerimiento->estado_requerimiento==2 or $requerimiento->estado_requerimiento==3)
<tr id="checkorden{{$requerimiento->id_requerimiento}}" >
     <td><center>{{$requerimiento->id_requerimiento}}</center></td>
  <td ><center class="label-{{validarColor($requerimiento->prioridad_requerimiento)}}" style="border-radius:2px;padding:2px;width:100%"><span class="label label-{{validarColor($requerimiento->prioridad_requerimiento)}}">{{validarLista($requerimiento->prioridad_requerimiento,2)}}</span></center></td>
<td><center>{{validarLista($requerimiento->estado_requerimiento, 1)}}</center></td>

  <td><center>{{strtoupper(validarHoras($requerimiento->tiempo_para_entrega))}}</center></td>

  <td><center>{{strtoupper(validarProducto($requerimiento->id_producto))}}</center></td>
  <td><center>{{strtoupper(validarUsuario($requerimiento->id_usuario))}}</center></td>
</tr>
  <tr>
    <div class="modal fade" id="showreq{{$requerimiento->id_requerimiento}}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
       <div class="modal-dialog modal-lg">
          <div class="modal-content">
             <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3>Informacion De la Orden</h3>
         </div>
             <div class="modal-body" >
              <div class="" id="tablareq{{$requerimiento->id_requerimiento}}">
              </div>
              <form role="form" enctype="multipart/form-data" method="POST" action="{{ url('show/process') }}">
              {{ csrf_field() }}
              <input type="hidden" name="id_requerimiento" value="{{$requerimiento->id_requerimiento}}">
              <input type="hidden" name="estado_requerimiento" value="{{$requerimiento->estado_requerimiento}}">
              <input type="hidden" name="link"></br>
              <input type="hidden" name="link"></br>
<div class="form-group">
  <label for="">Comentario</label>
  <textarea name="comentario" class="form-control"></textarea></br>

</div>
                @if($requerimiento->estado_requerimiento==1)
                <button type="submit" class="btn btn-primary" name="aceptar" id="aceptar">ACEPTAR</button>
                @endif
                @if($requerimiento->estado_requerimiento==2)
                <button type="submit" name="aceptar" class="btn btn-danger">PARAR</button>
                <button type="submit"  name="terminar" class="btn btn-success"  >TERMINAR</button>
                @endif
                @if($requerimiento->estado_requerimiento==3)
                <button type="submit" name="aceptar" class="btn btn-info">RETOMAR</button>
                <button type="submit" name="terminar" class="btn btn-success"  >TERMINAR</button>
                @endif
              </form>


            </div>
             <div class="modal-footer">
            <a href="./show?id={{$requerimiento->id_requerimiento}}" class="btn pull-left btn-primary">VER</a>
            <a href="#" data-dismiss="modal" class="btn btn-danger">Cerrar</a>
         </div>
          </div>
       </div>
    </div>
  </tr>

<script>
document.getElementById('checkorden{{$requerimiento->id_requerimiento}}').onclick = function() {
var url= {{$requerimiento->id_requerimiento}};
$("#tablareq{{$requerimiento->id_requerimiento}}").load("{!!url('/showupdate2?id="+url+"')!!}");
$("#showreq{{$requerimiento->id_requerimiento}}").modal("show");
}
</script>

    @endif
    @endif
  @endforeach
