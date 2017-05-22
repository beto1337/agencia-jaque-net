
@foreach($requerimiento as $requerimiento)

<tr>
<td>REALIZADO POR</td>
<td>{{validarUsuario($requerimiento->id_usuario)}}</td>
</tr>
<tr>
<td>ESTADO</td>
<td>{{validarLista($requerimiento->estado_requerimiento, 1)}}</td>
</tr>
<tr>
<td>FECHA DE ENTREGA</td>
<td>{{$requerimiento->fecha_limite_requerimiento}}</td>
</tr>
<tr>
<td>FECHA DE PEDIDO</td>
<td>{{$requerimiento->fecha_requerimiento}}</td>
</tr>
<tr>
<td>DETALLES</td>
<td>{{$requerimiento->nota_requerimiento}}</td>
</tr>
<tr>
<td>CLIENTE</td>
<td>{{validarCliente($requerimiento->id_cliente)}}</td>
</tr>
<tr>
<td>PRODUCTO</td>
<td>{{validarProducto($requerimiento->id_producto)}}</td>
<tr>
<td>APRUEBA</td>
<td>{{validarUsuario($requerimiento->aprobadopor)}}</td>
</tr>
<tr>
<td>OPERADOR</td>
<td>{{validarUsuario($requerimiento->id_operador)}}</td>
</tr>

</tr>
<tr>
<td>ARCHIVOS DE APOYO</td>
<td>
  <?php
  $link=$requerimiento->link_adjunto_requerimiento;
  if ($link==',') {
    echo '<h5>No se cargo ningun archivo</h5>';
  }
  $links=explode(",",$link);
  $contador=count($links);
    for ($i=0; $i <$contador ; $i++) {
      if ($links[$i]=='') {
      }else{
      echo "      <div style='padding:0px;width:100px;'>
            <a class= style='width:100px;padding:0px' target='_blank' href='".$links[$i]."'><img style='border-radius:10%' src='".$links[$i]."' alt='' alt='' width='100px' height='60px'/></a>
            <a class='btn btn-info btn-xs'  style='width:100px;padding:0px' target='_blank' href='".$links[$i]."' ><small><STRONG>VER</strong></small></a>
            <a class='btn btn-primary btn-xs' style='width:100px;padding:0px;' href='".$links[$i]."' download='".$links[$i]."'><small><STRONG>DESCARGAR</strong></small></a>
            </div>";
    }}
  ?>
</td>
</tr>
<tr>
@if ($requerimiento->estado_requerimiento > 1 and $requerimiento->estado_requerimiento < 7)
<td>TRABAJO REALIZADO</td>
<td>
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
      <a class='btn btn-danger btn-xs' style='width:100px;padding:0px;' href='./borrarimagen?link=".$links[$i]."&id=".$requerimiento->id_requerimiento."'><small><STRONG>ELIMINAR</strong></small></a>
      </div>
      ";
    }}
  ?>
</td>
</tr>
@endif
@endforeach
