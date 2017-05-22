<table  class="table table-condensed table-striped table-hover">
	<thead>
<tr>
	<th class="col-sm-9"><center>De</center></th>
	<th class="col-sm-3"><center>Hora</center></th>
</tr>
	</thead>

		<tbody>
	@foreach($chat as $mensaje)
	<tr onclick="verchat({{$mensaje->id_chat}})">
	@if($mensaje->from==Auth::user()->id)
	<td>{{validarUsuario($mensaje->to)}}<br>
	@else
	<td>{{validarUsuario($mensaje->from)}}<br>
	@endif
		{{$mensaje->mensaje}}</td>
		<td>{{$mensaje->fecha}}</td>
	</tr>
	@endforeach

		</tbody>


</table>
