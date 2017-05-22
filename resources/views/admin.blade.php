@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection

@section('main-content')

@if(Session::has('flash_message'))

<div class="alert alert-success alert-dismissable fade in">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong> {{Session::get('flash_message')}}
</div>
@endif

<div class="container spark-screen">
	<div class="row">
<section class="col-lg-9" style="padding:12px">
			<div class="panel panel-default" style="background-color:#605ca8">
			<div class="panel-heading titulopanel" id="titulo">
			<center><label class="labeltitle" style="font-size: 22px !important;" >MONITOR DE TAREAS</label></center></div>
</div>
</section>


			<div class="col-md-9 col-md-offset-0">
				<div class="panel panel-default">
					<div class="panel-heading titulopanel">
					<center>
						<label class=" labeltitle" >
						<input type="checkbox" id="checkpendientes" style="display:none" >  &nbsp; &nbsp; <label style="margin:0px;paddin:0px;color:black">qq</label> &nbsp; &nbsp;ORDENES PENDIENTES &nbsp; &nbsp; &nbsp;
						<span id="contadorpendientes" class="badge bg-light-blue" style="background-color:yellow !important;margin-top: -3px;color:black!important">{{$contadores['0']}}</span>
						</label>
					</center></div>
					<div class="panel-body" style="display:none" id="pendientes">

					<div class="table-responsive" >
						<table class="table table-condensed table-striped">
						 <thead>
				<tr style="background-color:#b0c4de;text-shadow: black 0.1em 0.1em 0.2em;font-size:12px;color:white">
                <th class="col-sm-1"><center>ID</center></th>
                <th class="col-sm-1"><center>PRIORIDAD</center></th>	
			 	<th class="col-sm-1"><center>ESTADO</center></th>
              			
    				<th class="col-sm-3"><center>CLIENTE</center></th>
  				<th class="col-sm-5"><center>PRODUCTO</center></th>
  				<th class="col-sm-1"><center>OPERADOR</center></th>
				</tr>
				</thead>

							 <tbody id="tablapendiente" style="font-size:12px">
							@include('layouts.partials.tablas.tabla')
							</tbody>
				
							<tbody id="tablaendevolucion" style="font-size:12px">
							@include('layouts.partials.tablas.tabladevolucion')
							 </tbody>
						</table>
				</div>

					</div>
					</div>




								<div class="panel panel-default">
									<div class="panel-heading titulopanel">
									<center>
										<label class=" labeltitle" >
										<input type="checkbox" id="checkproceso" style="display:none" > &nbsp; &nbsp;<label style="margin:0px;paddin:0px;color:black">11qq</label> ORDENES EN PROCESO Y PAUSADAS
										&nbsp;  <label style="margin:0px;paddin:0px;color:black">q</label>
										<span id="contadorproceso" class="badge bg-light-blue" style="background-color:yellow !important;margin-top: -3px;color:black !important">{{$contadores['1']}}</span>
										</label>
									</center></div>
									<div class="panel-body" style="display:none" id="proceso">

									<div class="table-responsive" >
										<table class="table table-condensed table-striped">
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


								<div class="panel panel-default">
									<div class="panel-heading titulopanel">
									<center>
										<label class=" labeltitle" >
										<input type="checkbox" id="checkaprobacion" style="display:none" >&nbsp; &nbsp;<label style="margin:0px;paddin:0px;color:black">11qq</label>APROBACION DE TAREAS
&nbsp;  <label style="margin:0px;paddin:0px;color:#622d71"></label>
										<span id="contadoraprobar" class="badge bg-light-blue" style="background-color:yellow !important;margin-top: -3px;color:black !important">{{$contadores['2']}}</span>
										</label>
									</center></div>
									<div class="panel-body" style="display:none" id="aprobacion">

									<div class="table-responsive" >
										<table class="table table-condensed table-striped">
											<thead>
<tr style="background-color:#b0c4de;text-shadow: black 0.1em 0.1em 0.2em;font-size:12px;color:white">
	<th class="col-sm-1"><center>ID</center></th>
	<th class="col-sm-1"><center>PRIORIDAD</center></th>
	<th class="col-sm-2"><center>APROBADOR</center></th>
	<th class="col-sm-5"><center>PRODUCTO</center></th>
	<th class="col-sm-3"><center>CLIENTE</center></th>

</tr>
</thead>

											 <tbody id="tablaporaprobar" style="font-size:12px">
											@include('layouts.partials.tablas.tablaporaprobar')
											</tbody>
											
										 
										</table>
								</div>

									</div>
									</div>



					</div>
				</div>
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
					setInterval(loadrequerimientos,3000);
					});

					function loadrequerimientos(){
					$("#tablapendiente").load("{!!url('/adminupdate?id=1')!!}");
					$("#tablaenproceso").load("{!!url('/adminupdate?id=2')!!}");
					$("#tablaporaprobar").load("{!!url('/adminupdate?id=3')!!}");
					$("#tablaendevolucion").load("{!!url('/adminupdate?id=4')!!}");
					

					$("#contadorpendientes").load("{!!url('/admincontador?id=0')!!}");
					$("#contadorproceso").load("{!!url('/admincontador?id=1')!!}");
					$("#contadoraprobar").load("{!!url('/admincontador?id=2')!!}");
					}

			</script>


@endsection
