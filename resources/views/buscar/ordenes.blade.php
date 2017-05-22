@extends('layouts.app')

@section('htmlheader_title')
	CLIENTES
@endsection
@section('main-content')
  <div class="row">
						<div class="col-lg-12">
							<div class="box box-primary">
							            <div class="box-header">
							              <h3 class="box-title">Historico Ordenes</h3>
							            </div>
							            <div class="box-body">
							              <table id="ordenes" class="table table-bordered table-striped">
							                <thead>
							                <tr>
							                  <th>Remitente</th>
							                  <th>Destinatario</th>
							                  <th>Fecha de orden</th>
                                <th>Fecha maxima de entrega</th>
                                <th>MAS</th>
							                </tr>
							                </thead>
							                <tbody>
															@foreach ($requerimientos as $requerimiento)
																<tr>
																	<td>{{validarUsuario($requerimiento->id_usuario)}}</td>
																	<td>{{validarUsuario($requerimiento->id_operador)}}</td>
																	<td>{{$requerimiento->fecha_requerimiento}}</td>
																	<td>{{validarCliente($requerimiento->id_cliente)}}</td>
																	<td><a href="./show?id={{$requerimiento->id_requerimiento}}">mas</a></td>
																</tr>
															@endforeach

															</tbody>
														  <tfoot>
														  <tr>
                                <th>Remitente</th>
							                  <th>Destinatario</th>
							                  <th>Fecha de orden</th>
                                <th>Fecha maxima de entrega</th>
                                  <th>MAS</th>
															 </tr>
															 </tfoot>
															 </table>
														 </div>
														 </div>
													 </div>


</div>
<script type="text/javascript">
$(function () {
	$("#ordenes").DataTable({
		"language": {
					"lengthMenu": "Mostrar _MENU_ ordenes por pagina",
					"zeroRecords": "No hay ordenes registradas",
					"info": "Pagina _PAGE_ de _PAGES_",
					"infoEmpty": "Ninguna orden encontrada",
					"infoFiltered": "(Filtrado de _MAX_ ordenes )",
					"search":         "Buscar:",
					"paginate": {
			"first":      "Primero",
			"last":       "Ultimo",
			"next":       "Siguiente",
			"previous":   "Anterior"
	}
			}
	});
});

</script>
@endsection
