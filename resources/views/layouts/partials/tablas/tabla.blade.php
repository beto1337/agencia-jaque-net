@foreach($requerimientos as $requerimiento)
@if ($requerimiento->estado_requerimiento==1)

  <tr id="checkorden{{$requerimiento->id_requerimiento}}">
       <td><center>{{$requerimiento->id_requerimiento}}</center></td>
      <td ><center class="label-{{validarColor($requerimiento->prioridad_requerimiento)}}" style="border-radius:2px;padding:2px;width:100%"><span class="label label-{{validarColor($requerimiento->prioridad_requerimiento)}}">{{validarLista($requerimiento->prioridad_requerimiento,2)}}</span></center></td>
      <td><center>{{validarLista($requerimiento->estado_requerimiento, 1)}}</center></td>
 
    <td><center>{{validarCliente($requerimiento->id_cliente)}}</center></td>
    <td><center>{{validarProducto($requerimiento->id_producto)}}</center></td>
    <td><center>{{validarUsuario($requerimiento->id_operador)}}</center></td>
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
  @endforeach
