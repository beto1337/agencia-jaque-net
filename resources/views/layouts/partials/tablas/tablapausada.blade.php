@foreach($requerimientos as $requerimiento)
@if ($requerimiento->estado_requerimiento==3)
<tr>
  <td><span class="label label-{{validarColor($requerimiento->prioridad_requerimiento)}}">{{validarLista($requerimiento->prioridad_requerimiento,2)}}</span></td>
<td>{{validarUsuario(validarOperador($requerimiento->id_requerimiento,3))}}</td>
<td>{{validarHoras($requerimiento->tiempo_para_entrega)}}</td>
  <td>{{validarCliente($requerimiento->id_cliente)}}</td>
  <td>{{validarProducto($requerimiento->id_producto)}}</td>
  <td><a href="./show?id={{$requerimiento->id_requerimiento}}"><i class='fa fa-plus-square'></i></a>
  </td>
</tr>
    @endif
  @endforeach
