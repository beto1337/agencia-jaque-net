@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection

@section('main-content')

@if(Session::has('flash_message'))
<div class="alert alert-success alert-dismissable fade in">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>importante!</strong> {{Session::get('flash_message')}}
</div>
@endif

@if(Session::has('flash_message_noacepta'))
<div class="alert alert-danger alert-dismissable fade in">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>importante! </strong> {{Session::get('flash_message_noacepta')}}
</div>
@endif

	<div class="row">
<section class="col-lg-9" style="padding-top:8fpx;padding-bottom:8px">
			<div class="panel panel-default" style="background-color:#605ca8">
			<div class="panel-heading titulopanel" id="titulo">
			<center><label class="labeltitle" style="font-size: 22px !important;" >MIS TAREAS</label></center></div>
</div>
</section>

			<section class="col-lg-9">
				<div class="panel panel-default" style="margin-bottom: 24px;">
					<div class="panel-heading titulopanel">
					<center>
						<label class=" labeltitle" >
						<input type="checkbox" id="checkpendientes" style="display:none" >  &nbsp; &nbsp; <label style="margin:0px;paddin:0px;color:black">qq</label> &nbsp; &nbsp;ORDENES PENDIENTES &nbsp; &nbsp; &nbsp;
						<span id="contadorpendientes" class="badge bg-light-blue" style="background-color:#D91982 !important;color:white !important;margin-top: -3px;">{{$contadores['0']}}</span>
						</label>
					</center></div>
					<div class="panel-body" style="display:block" id="pendientes">

					<div class="table-responsive" >
						<table class="table table-condensed table-striped table-hover">

							<thead>
						<tr style="text-shadow: black 0.1em 0.1em 0.2em;font-size:12px;color:white">
						<th class="col-sm-1"><center>ID</center></th>
						<th class="col-sm-1"><center>PRIORIDAD</center></th>
            <th class="col-sm-2"><center>TIEMPO ENTREGA</center></th>
    				<th class="col-sm-3"><center>CLIENTE</center></th>
  					<th class="col-sm-3"><center>PRODUCTO</center></th>
						<th class="col-sm-2"><center>OPERADOR</center></th>
						 </tr>
						  </thead>

							 <tbody id="tablapendiente" style="font-size:12px">
							@include('layouts.partials.tablas.tabla')
							</tbody>
						</table>
				</div>
					</div>
					</div>

										<div class="panel panel-default"  style="margin-bottom: 24px;">
											<div class="panel-heading titulopanel">
											<center>
												<label class=" labeltitle" >
												<input type="checkbox" id="checkespera" style="display:none" > &nbsp; &nbsp; <label style="margin:0px;paddin:0px;color:black">qq</label> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;MIS TAREAS
												 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
												<span id="contadoespera" class="badge bg-light-blue" style="background-color:#D91982 !important;color:white !important;margin-top: -3px;">{{$contadores['1']}}</span>
												</label>
											</center></div>
											<div class="panel-body" style="display:none" id="espera">

											<div class="table-responsive" >
												<table class="table table-condensed table-striped table-hover">
													<thead				<tr style="background-color:#b0c4de;text-shadow: black 0.1em 0.1em 0.2em;font-size:12px;color:white">
														<th class="col-sm-1"><center>ID</center></th>
														<th class="col-sm-1"><center>PRIORIDAD</center></th>
														<th class="col-sm-2"><center>ESTADO</center></th>
									            <th class="col-sm-2"><center>TIEMPO ENTREGA</center></th>
									  					<th class="col-sm-4"><center>PRODUCTO</center></th>
									  					<th class="col-sm-2"><center>SOLICITADO POR</center></th>
														</tr>
													</thead>

													 <tbody id="tablamistareas" style="font-size:12px">
													@include('layouts.partials.tablas.tablamistareas')
													</tbody>
												</table>
										</div>

											</div>
											</div>



													<div class="panel panel-default"  style="margin-bottom: 24px;">
														<div class="panel-heading titulopanel">
														<center>
															<label class=" labeltitle" >
															<input type="checkbox" id="checkproceso" style="display:none" > &nbsp; &nbsp;<label style="margin:0px;paddin:0px;color:black">11qq</label> ORDENES EN PROCESO
															&nbsp;  <label style="margin:0px;paddin:0px;color:black">q</label>
															<span id="contadorproceso" class="badge bg-light-blue" style="background-color:#D91982 !important;color:white !important;margin-top: -3px;">{{$contadores['2']}}</span>
															</label>
														</center></div>
														<div class="panel-body" style="display:none" id="proceso">

														<div class="table-responsive" >
															<table class="table table-condensed table-striped table-hover">
																<thead>
																	<tr style="background-color:#b0c4de;text-shadow: black 0.1em 0.1em 0.2em;font-size:12px;color:white">
<th class="col-sm-1"><center>ID</center></th>
<th class="col-sm-1"><center>PRIORIDAD</center></th>
										<th class="col-sm-2"><center>ESTADO</center></th>
										<th class="col-sm-6"><center>PRODUCTO</center></th>
										<th class="col-sm-2"><center>OPERADOR</center></th>
																	</tr>
																</thead>

																 <tbody id="tablaenproceso" style="font-size:12px">
																@include('layouts.partials.tablas.tablaenproceso')
																</tbody>

															</table>
													</div>

														</div>
														</div>


													<div class="panel panel-default"  style="margin-bottom: 24px;">
														<div class="panel-heading titulopanel">
														<center>
															<label class=" labeltitle" >
															<input type="checkbox" id="checkaprobacion" style="display:none" >&nbsp; &nbsp;<label style="margin:0px;paddin:0px;color:black !important">11qq</label>APROBACION DE TAREAS
															&nbsp;  <label style="margin:0px;paddin:0px;color:#622d71"></label>
															<span id="contadoraprobar" class="badge bg-light-blue" style="background-color:#D91982 !important;margin-top: -3px;">{{$contadores['3']}}</span>
															</label>
														</center></div>
														<div class="panel-body" style="display:none" id="aprobacion">

														<div class="table-responsive" >
															<table class="table table-condensed table-striped table-hover">
																<thead>
																	<tr style="background-color:#b0c4de;text-shadow: black 0.1em 0.1em 0.2em;font-size:12px;color:white">
<th class="col-sm-1"><center>ID</center></th>
																			<th class="col-sm-1"><center>PRIORIDAD</center></th>
	<th class="col-sm-2"><center>OPERADOR</center></th>
	<th class="col-sm-5"><center>PRODUCTO</center></th>
	<th class="col-sm-3"><center>CLIENTE</center></th>										</tr>
																</thead>

																 <tbody id="tablaporaprobar" style="font-size:12px">
																@include('layouts.partials.tablas.tablaporaprobar')
																</tbody>


															</table>
													</div>

														</div>
														</div>


					</section>
				</div>

			                  <script>

			            					document.getElementById('checkpendientes').onclick = function() {
			            					element = document.getElementById("pendientes");
			            						check = document.getElementById("checkpendientes");
			            						if (check.checked) {
			            								element.style.display='block';

			            						}
			            						else {
			            								element.style.display='none';

			            						}
			            					}


			            					document.getElementById('checkespera').onclick = function() {
			            					element = document.getElementById("espera");
			            						check = document.getElementById("checkespera");
			            						if (check.checked) {
			            								element.style.display='block';

			            						}
			            						else {
			            								element.style.display='none';

			            						}
			            					}
			            					document.getElementById('checkproceso').onclick = function() {
			            					element = document.getElementById("proceso");
			            						check = document.getElementById("checkproceso");
			            						if (check.checked) {
			            								element.style.display='block';

			            						}
			            						else {
			            								element.style.display='none';

			            						}
			            					}
			            					document.getElementById('checkaprobacion').onclick = function() {
			            					element = document.getElementById("aprobacion");
			            						check = document.getElementById("checkaprobacion");
			            						if (check.checked) {
			            								element.style.display='block';

			            						}
			            						else {
			            								element.style.display='none';

			            						}
			            					}
			            					$(document).ready(function(){

			            					setInterval(loadrequerimientos,15000);
			            					});

			            					function loadrequerimientos(){
			            					$("#tablapendiente").load("{!!url('/homeupdate?id=1')!!}");
			            					$("#tablamistareas").load("{!!url('/homeupdate?id=2')!!}");
			            					$("#tablaenproceso").load("{!!url('/homeupdate?id=3')!!}");
			            					$("#tablaporaprobar").load("{!!url('/homeupdate?id=4')!!}");
			            					$("#tablaendevolucion").load("{!!url('/homeupdate?id=5')!!}");
			            					$("#tablaaprobado").load("{!!url('/homeupdate?id=6')!!}");

			            					$("#contadorpendientes").load("{!!url('/contador?id=0')!!}");
			            					$("#contadorespera").load("{!!url('/contador?id=1')!!}");
			            					$("#contadorproceso").load("{!!url('/contador?id=2')!!}");
			            					$("#contadoraprobar").load("{!!url('/contador?id=3')!!}");
			            					}
														window.onload=loadrequerimientos;

			            			</script>
			@endsection
