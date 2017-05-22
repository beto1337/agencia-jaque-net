
@foreach($requerimiento as $requerimiento)
<div class="table-responsive">
<table class="table table-striped">
  <tr class="col-sm-12">
    <td class="col-sm-1">ESTADO:</td>
    <td class="col-sm-2">{{validarLista($requerimiento->estado_requerimiento, 1)}}</td>

  <td class="col-sm-2">REALIZADO POR</td>
  <td class="col-sm-2">{{validarUsuario($requerimiento->id_usuario)}}</td>

  <td class="col-sm-2">F. ENTREGA:</td>
  <td class="col-sm-2">{{$requerimiento->fecha_limite_requerimiento}}</td>

  </tr>
  <tr class="col-sm-12">
    <td class="col-sm-1">CLIENTE:</td>
    <td class="col-sm-2">{{validarCliente($requerimiento->id_cliente)}}</td>

    <td class="col-sm-2">PRODUCTO: </td>
    <td class="col-sm-2">{{validarProducto($requerimiento->id_producto)}}</td>

    <td class="col-sm-2">F. ORDEN:</td>
    <td class="col-lg-2">{{$requerimiento->fecha_requerimiento}}</td>
  </tr>

  <tr class="col-sm-12">
  <td class="col-sm-1">DETALLES:</td>
  <td class="col-sm-11">{{$requerimiento->nota_requerimiento}}</td>
  </tr>

</table>
</div>


  @endforeach
