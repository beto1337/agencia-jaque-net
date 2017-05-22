
    @foreach($requerimientos as $requerimiento)
    @if ($requerimiento->estado_requerimiento==5 )
    <tr id="checkorden{{$requerimiento->id_requerimiento}}" >
    <td>{{validarLista($requerimiento->estado_requerimiento, 1)}}</td>
    <td ><center style="margin:0px"><span class="label label-{{validarColor($requerimiento->prioridad_requerimiento)}}">{{validarLista($requerimiento->prioridad_requerimiento,2)}}</span></center></td>
    <td><center>{{validarHoras($requerimiento->tiempo_para_entrega)}}</center></td>
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
                <div class="panel panel-default">
                  <div class="panel-heading"><label>TRABAJO REALIZADO</labels></div>
                  <div class="panel-body">

                        <?php
                        $link=$requerimiento->trabajo_realizado;
                        if ($link==',') {
                          echo '<h5>No se cargo ningun archivo</h5>';
                        }
                        $links=explode(",",$link);
                        $contador=count($links);
                          for ($i=0; $i <$contador ; $i++) {
                            if ($links[$i]=='') {
                            }else{
                            echo "
                            <div class='btn-group-vertical' style='padding:2px'>
                            <a class= style='width:100px;padding:1px;bottom:2px' target='_blank' href='".$links[$i]."'><img style='border-radius:10%' src='".$links[$i]."' alt='' width='100px' height='60px' /></a>
                            <a class='btn btn-info btn-xs'  style='width:100px;margin-top:2px' target='_blank' href='".$links[$i]."' ><small><STRONG>VER</strong></small></a>
                            <a class='btn btn-primary btn-xs' style='width:100px;padding:0px;' href='".$links[$i]."' download='".$links[$i]."'><small><STRONG>DESCARGAR</strong></small></a>
                            </div>
                            ";
                          }}
                        ?>
                  </div>
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
