<?php
use Carbon\Carbon;

function validarUsuario($id)
{
  $usuario = DB::table('users')->select('name')->where('id',$id)->take(1)->get();
    foreach ($usuario as $value) {
      $user=$value->name;
    }
    if (empty($user)) {
      $user="";
    }
return $user;
}
function validarcorreo($id)
{
  $usuario = DB::table('users')->select('email')->where('id',$id)->take(1)->get();
    foreach ($usuario as $value) {
      $email=$value->email;
    }
return $email;
}

function validarFecha($fecha, $tiempo)
{
  if ($tiempo<=12) {
    $show=substr($fecha,11);
  }else {
    $show=substr($fecha,0, 10);
  }
  return $show;
}

function validarCliente($id_cliente)
{
  $cliente = DB::table('app_clientes')->select('alias','nombre_cliente','apellido_cliente')->where('id_cliente',$id_cliente)->take(1)->get();
    foreach ($cliente as $value) {
      $client=$value->alias;
    }
if (empty($client)) {
  $client=''. $id_cliente;
}
return $client;

}

function validarProducto($id_producto)
{
  $productos = DB::table('app_productos')->select('nombre_producto')->where('id_producto',$id_producto)->take(1)->get();
    foreach ($productos as $value) {
      $producto=$value->nombre_producto;
    }
    if (empty($producto)) {
      $producto="";
    }
    $tamano=strlen($producto);
if($tamano>35){
$producto=substr($producto, 0, 34);
$producto=$producto."...";
}

return $producto;
}



function validarLista($valor_lista, $tipo_lista)
{
  $estados = DB::table('app_listas')->select('item_lista')->where('id_tipo_lista',$tipo_lista)->
  where('valor_lista',$valor_lista)->get();
    foreach ($estados as $value) {
      if ($value->valor_lista=$valor_lista) {
        $estado=$value->item_lista;
      break;
      }
    }
return $estado;
}

function validarColor($prioridad){
if ($prioridad==1) {
  echo  "danger";
}elseif($prioridad==2) {
echo  "warning";
}elseif ($prioridad==3) {
echo "success";
}
}
function validarHoras($horas){
  if($horas>24){
    $show=(int)($horas/24);
    return $show." Dias";
  }elseif($horas<0){
   return "Tiempo Superado";
}else {
    return $horas." Horas";
  }
}
function ValidarAccion($estado,$usuario,$caso,$requerimiento_id)
{
$idusuario = Auth::user()->id;
//caso1=operador
//caso2=quienrequiere
//caso3aprobador
//Caso4 quienrequiere==quien aprueba
if ($caso==1) {
if ($estado==1) {
  $seguimientos=DB::table('app_seguimientos')->select('comentario_seguimiento')->where('estado_requerimiento',$estado)
  ->orderBy('fecha_seguimiento','desc')->take(1)->get();
  foreach ($seguimientos as $value) {
    $comentario=$value->comentario_seguimiento;
  }
if (empty($comentario)) {
  echo '<button type="submit" class="btn btn-primary" style="margin:5px;" name="aceptar" id="aceptar">ACEPTAR</button>
  <h5 style="color:gray"><input type="checkbox" id="check" value="1" name="brand" onchange="javascript:showContent()">
  Seleccione si mandara a corregir la orden.</h5>
';
}else {
  echo '<h6 class="alert alert-danger"><strong>detalles de la devolucion: </strong>'.$comentario.'</h6></br>
  <button type="submit" class="btn btn-primary" style="margin:5px;" name="aceptar" id="aceptar">ACEPTAR</button>
  <h5 style="color:gray"><input type="checkbox" id="check" value="1" name="brand" onchange="javascript:showContent()">
  Seleccione si mandara a corregir la orden.</h5>
';
}



}elseif($estado==2 or $estado==3) {

}elseif ($estado==4) {
  echo "<h1>Esperando Aprobacion Del Area Encargada</h1>";
}elseif ($estado==5) {
}elseif ($estado==6) {
      $seguimientos=DB::table('app_seguimientos')->select('comentario_seguimiento')->where('estado_requerimiento',$estado)
      ->orderBy('fecha_seguimiento','desc')->take(1)->get();
      foreach ($seguimientos as $value) {
        $comentario=$value->comentario_seguimiento;
      }
  echo '<h6 class="alert alert-danger"><strong>detalles de la devolucion: </strong>'.$comentario.'</h6></br>
  <button type="submit" class="btn btn-primary" style="margin:5px;" name="aceptar" id="aceptar">ACEPTAR</button>
  <h5 style="color:gray"><input type="checkbox" id="check" value="1" name="brand" onchange="javascript:showContent()">
  Seleccione si mandara a corregir la orden.</h5>';

}elseif ($estado==7) {
  echo "<h1>Esperando Correccion Del Area Encargada</h1>";
}
  }elseif ($caso==2) {
    if ($estado==1) {
      echo '<h5>En espera de aceptacion o correccion por parte del operador </h5>';
    }elseif($estado==2 or $estado==3) {
      echo "<h5>En Proceso</h5>";
    }elseif ($estado==4) {
      echo "<h1>Esperando Aprobacion Del Area Encargada</h1>";
    }elseif ($estado==5) {
      echo "<h1>Trabajo Terminado y Aprobado </h1>";
      $seguimientos=DB::table('app_seguimientos')->select('comentario_seguimiento')->where('estado_requerimiento',$estado-1)
      ->orderBy('fecha_seguimiento','desc')->take(1)->get();
      foreach ($seguimientos as $value) {
        $comentario=$value->comentario_seguimiento;
      }
  echo '<h6 class="alert alert-info"><strong>Ultimo detalle registrado: </strong>'.$comentario.'</h6></br>
';
    }elseif ($estado==6) {
      echo "<h1>Trabajo no cumplio con las espectativas, por lo que no se enuentra en devolucion  </h1>";
    }elseif ($estado==7) {

      $seguimientos=DB::table('app_seguimientos')->select('comentario_seguimiento')->where('estado_requerimiento',$estado)
      ->orderBy('fecha_seguimiento','asc')->take(1)->get();
      foreach ($seguimientos as $value) {
        $comentario=$value->comentario_seguimiento;
      }
  echo '<h6 class="alert alert-danger"><strong>detalles de la devolucion: </strong>'.$comentario.'</h6></br>
  <button type="submit" class="btn btn-primary" style="margin:5px;" name="aceptar" id="aceptar">ACEPTAR</button>';
}
  }elseif ($caso==3) {
    if ($estado==1) {
      echo '<h5>En espera de aceptacion o correccion por parte del operador </h5>';
    }elseif($estado==2 or $estado==3) {
      echo "<h5>En Proceso</h5>";
    }elseif ($estado==4) {
      $seguimientos=DB::table('app_seguimientos')->select('comentario_seguimiento')->where('estado_requerimiento',$estado)
      ->orderBy('fecha_seguimiento','desc')->take(1)->get();
      foreach ($seguimientos as $value) {
        $comentario=$value->comentario_seguimiento;
      }
  echo '<h6 class="alert alert-danger"><strong>detalles de la devolucion: </strong>'.$comentario.'</h6></br>
';
      echo '<label for="ejemplo_email_1">detalles del pedido</label>
      <textarea type="text" class="form-control" rows="3" id="comentario" name="comentario"
      placeholder="Ingrese la razon por la que devuelve el pedido."></textarea >

      <button type="submit"  style="margin:5px;" class="btn btn-default" name="aceptar" id="aceptar">Aprobar</button><br>
      <button type="submit"  style="margin:5px;" class="btn btn-default" name="devolver" id="devolver" >devolver a produccion</button>
      ';
    }elseif ($estado==5) {
      $seguimientos=DB::table('app_seguimientos')->select('comentario_seguimiento')->where('estado_requerimiento',$estado-1)
      ->orderBy('fecha_seguimiento','desc')->take(1)->get();
      foreach ($seguimientos as $value) {
        $comentario=$value->comentario_seguimiento;
      }
  echo '<h6 class="alert alert-info"><strong>Ultimo detalle registrado: </strong>'.$comentario.'</h6></br>
';
      echo "<h1>Trabajo Terminado y Aprobado </h1>";
    }elseif ($estado==6) {

      echo "<h1>Trabajo no cumplio con las espectativas, por lo que no se enuentra en devolucion con los siguientes detalles: </h1>";
      $seguimientos=DB::table('app_seguimientos')->select('comentario_seguimiento')->where('estado_requerimiento',$estado)
      ->orderBy('fecha_seguimiento','desc')->take(1)->get();
      foreach ($seguimientos as $value) {
        $comentario=$value->comentario_seguimiento;
      }
  echo '<h6 class="alert alert-danger"><strong>Ultimo detalle registrado: </strong>'.$comentario.'</h6></br>
';
    }elseif ($estado==7) {
      echo "<h1>El operador no entendio que debia hacer por lo que mando a correccion la orden</h1>";
  }
}  elseif ($caso==4) {
    if ($estado==1) {
        echo '<h5>En espera de aceptacion o correccion por parte del operador </h5>';
      }elseif($estado==2 or $estado==3) {
        echo "<h5>En Proceso</h5>";
      }elseif ($estado==4) {
        $seguimientos=DB::table('app_seguimientos')->select('comentario_seguimiento')->where('estado_requerimiento',$estado)
        ->orderBy('fecha_seguimiento','desc')->take(1)->get();
        foreach ($seguimientos as $value) {
          $comentario=$value->comentario_seguimiento;
        }
    echo '<h6 class="alert alert-info"><strong>Ultimo detalle registrado: </strong>'.$comentario.'</h6></br>
  ';
        echo '<label for="ejemplo_email_1">detalles del pedido</label>
        <textarea type="text" class="form-control" rows="3" id="comentario" name="comentario"
        placeholder="Ingrese la razon por la que devuelve el pedido."></textarea >
        <button type="submit"  style="margin:5px;" class="btn btn-default" name="aceptar" id="aceptar">Aprobar</button><br>
        <button type="submit"  style="margin:5px;" class="btn btn-default" name="devolver" id="devolver" >devolver a produccion</button>
        ';
      }elseif ($estado==5) {
        echo "<h1>Trabajo Terminado y Aprobado </h1>";
        $seguimientos=DB::table('app_seguimientos')->select('comentario_seguimiento')->where('estado_requerimiento',$estado-1)
        ->orderBy('fecha_seguimiento','desc')->take(1)->get();
        foreach ($seguimientos as $value) {
          $comentario=$value->comentario_seguimiento;
        }
    echo '<h6 class="alert alert-info"><strong>Ultimo detalle registrado: </strong>'.$comentario.'</h6></br>
  ';
      }elseif ($estado==6) {
        echo "<h1>Trabajo no cumplio con las espectativas, por lo que no se enuentra en devolucion  </h1>";
        $seguimientos=DB::table('app_seguimientos')->select('comentario_seguimiento')->where('estado_requerimiento',$estado)
        ->orderBy('fecha_seguimiento','desc')->take(1)->get();
        foreach ($seguimientos as $value) {
          $comentario=$value->comentario_seguimiento;
        }
    echo '<h6 class="alert alert-danger"><strong>Ultimo detalle registrado: </strong>'.$comentario.'</h6></br>
  ';
      }elseif ($estado==7) {

      $seguimientos=DB::table('app_seguimientos')->select('comentario_seguimiento')->where('estado_requerimiento',$estado)
      ->orderBy('fecha_seguimiento','asc')->take(1)->get();
      foreach ($seguimientos as $value) {
        $comentario=$value->comentario_seguimiento;
        }

      echo '<h6 class="alert alert-danger"><strong>detalles de la devolucion: </strong>'.$comentario.'</h6></br>
      <label for="ejemplo_email_1">Comentario Para El Operador</label>
      <textarea type="text" class="form-control" rows="3" id="comentario" name="comentario"
      placeholder="Si tiene algun comentario escribalo aqui."></textarea >
      <a href="./editarordenf?id='.$requerimiento_id.'" class="btn btn-danger" style >Editar orden</a>
      <button type="submit" class="btn btn-primary" style="margin:5px;" name="aceptar" id="aceptar">ACEPTAR</button>';
  }
}
}


function validarlogeado($id){
    $idusuario = Auth::user()->id;
    if ($id==$idusuario) {
      return "block";
    }
    else {
      return "none";
    }
}
  function validarcomentario($estado)
  {
    $seguimientos=DB::table('app_seguimientos')->select('comentario_seguimiento')->where('estado_requerimiento',$estado)
    ->orderBy('fecha_seguimiento','asc')->take(1)->get();
    foreach ($seguimientos as $value) {
      $comentario=$value->comentario_seguimiento;
    }
    if ($comentario=='revisado y devuelto a produccion') {
      echo "<h5 style='color:green'>no se genero ningun comentario de devolucion</h5>";
    }
    else {
      echo '<h6 class="alert alert-danger"><strong>Ultimo Detalle: </strong>'.$comentario.'</h6></br>';
    }
  }
function validarColorestado($estado){
if ($estado==1 or $estado==3) {
  echo  "danger";
}elseif($estado==2) {
echo  "info";
}elseif ($estado==4) {
echo "warning";
}elseif($estado==7) {
  echo "default";
}elseif ($estado==6) {
  echo '" style="background-color:black';
}elseif($estado==5) {
  echo "success";
}

}




function validarNivel(){

$perfil = Auth::user()->id_perfil;

if ($perfil<5 and $perfil>2) {
 return true;
}
    else {
      return false;
    }
  }
function producto($idproducto){
$seguimientos=DB::table('app_productos')->select('id_divisiones')->where('id_producto',$idproducto)->take(1)->get();
foreach ($seguimientos as $value) {
      $id_division=$value->id_divisiones;
    }
return $id_division;

  }
 function validarOperador($id,$estado){
  $seguimientos=DB::table('app_seguimientos')->select('id_usuario')->where('id_requerimiento',$id)->where('estado_requerimiento',$estado)
  ->orderBy('fecha_seguimiento','asc')->take(1)->get();
  foreach ($seguimientos as $value) {
    $useri=$value->id_usuario;
  }
return $useri;
}
function validarTrabajo($id,$estado){
 $seguimientos=DB::table('app_seguimientos')->select('tiempo_trabajado')->where('id_requerimiento',$id)->where('estado_requerimiento',$estado)
 ->orderBy('fecha_seguimiento','asc')->take(1)->get();
 foreach ($seguimientos as $value) {
   $tiempo=$value->tiempo_trabajado;
 }
return $tiempo;
}
function validartiempotrabajado($fechainicio)
{
  $fechahoy=Carbon::now();
  $fechainicio=Carbon::parse($fechainicio);
  $diastrabajof=($fechahoy->dayOfYear)*1440;
  $diastrabajoi=($fechainicio->dayOfYear)*1440;
  $horastrabajof=($fechahoy->hour)*60;
  $horastrabajoi=($fechainicio->hour)*60;
  $minutostrabajof=($fechahoy->minute);
  $minutostrabajoi=($fechainicio->minute);
  $tiempototal=($diastrabajof+$horastrabajof+$minutostrabajof)-($diastrabajoi+$horastrabajoi+$minutostrabajoi);
  return $tiempototal;
}
function correo($id_req, $destinatario , $fechareq, $nota, $cliente, $producto ,$caso, $msj , $remitente)
{
$linkorden='<a href="http://net.agenciajaque.com/public/show?id='.$id_req.'" class="myButton">REVISAR ORDEN</a>';
if ($caso==1) {//caso envio a operador
$mensaje='<strong>IMPORTANTE! </strong> <p>El usuario '. strtoupper($remitente).' le ha a asignado una nueva orden de trabajo
con los siguientes parametros.';
}elseif ($caso==2) {
$mensaje='<strong>IMPORTANTE! </strong> <p>El usuario '. strtoupper($remitente).
' ha devuelto su orden de trabajo con el siguiente mensaje: '.$msj;
$linkorden='<a href="http://net.agenciajaque.com/public/editarordenf?id='.$id_req.'" class="myButton">REVISAR ORDEN</a>';
}elseif ($caso==3) {
$mensaje='<strong>IMPORTANTE! </strong> <p>El usuario '. strtoupper($remitente).
' ha corregido la orden de trabajo con el siguiente mensaje: : '.$msj;
}elseif ($caso==4) {
  $mensaje='<strong>IMPORTANTE! </strong> <p>El usuario '. strtoupper($remitente).
  ' ha terminado un trabajo y necesita tu aprobaci��n, los detalles de la orden son los siguientes. ' .$msj;
}elseif ($caso==5) {
  $mensaje='<strong>IMPORTANTE! </strong> <p>El usuario '.strtoupper($remitente).
  ' No ha aprobado el trabajo y lo ha devuelto con el siguiente mensaje: '.$msj;
}
elseif ($caso==6) {
  $mensaje='<strong>IMPORTANTE! </strong> <p>Hola '.strtoupper($remitente).
  ' El trabajo que mandaste ha hacer ha finalizado ';
}



$html='<html >
 <head><meta http-equiv="Content-Type" content="text/html; charset=big5">

<title>Demystifying Email Design</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<style >
.myButton {
	-moz-box-shadow:inset 0px 1px 0px 0px #eb0cd1;
	-webkit-box-shadow:inset 0px 1px 0px 0px #eb0cd1;
	box-shadow:inset 0px 1px 0px 0px #eb0cd1;
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #ff00cc), color-stop(1, #5a0fa1));
	background:-moz-linear-gradient(top, #ff00cc 5%, #5a0fa1 100%);
	background:-webkit-linear-gradient(top, #ff00cc 5%, #5a0fa1 100%);
	background:-o-linear-gradient(top, #ff00cc 5%, #5a0fa1 100%);
	background:-ms-linear-gradient(top, #ff00cc 5%, #5a0fa1 100%);
	background:linear-gradient(to bottom, #ff00cc 5%, #5a0fa1 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#ff00cc", endColorstr="#5a0fa1",GradientType=0);
	background-color:#ff00cc;
	-moz-border-radius:3px;
	-webkit-border-radius:3px;
	border-radius:3px;
	border:1px solid #670280;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Arial;
	font-size:13px;
	font-weight:bold;
  margin-top: 20px;
	padding:6px 24px;
	text-decoration:none;
	text-shadow:2px 2px 2px #200730;
}
.myButton:hover {
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #5a0fa1), color-stop(1, #ff00cc));
	background:-moz-linear-gradient(top, #5a0fa1 5%, #ff00cc 100%);
	background:-webkit-linear-gradient(top, #5a0fa1 5%, #ff00cc 100%);
	background:-o-linear-gradient(top, #5a0fa1 5%, #ff00cc 100%);
	background:-ms-linear-gradient(top, #5a0fa1 5%, #ff00cc 100%);
	background:linear-gradient(to bottom, #5a0fa1 5%, #ff00cc 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#5a0fa1", endColorstr="#ff00cc",GradientType=0);
	background-color:#5a0fa1;
}
.myButton:active {
	position:relative;
	top:1px;
}
</style>

</head>


<body style="margin: 0; padding: 10px; ">
 <table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
 <td>
   <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="padding:10px;background-color:#431E50;border-radius:2%">
    <tr>
   <td bgcolor="" style="padding:0;color:white">
<center>
<img src="https://s3-us-west-2.amazonaws.com/agencia-jaque/gestion/pllantilla1-plataforma.jpg" alt="Una Nueva Cultura" border="5px" style="display: block;" />
</center>
   </td>
    </tr>
    <tr>
      <td>
<center>
  <img src="https://s3-us-west-2.amazonaws.com/agencia-jaque/gestion/11.png" alt="Una Nueva Cultura" border="5px" style="display: block;;border-color:white;background-color:white" />
</center>
      </td>
    </tr>
    <tr>
      <td bgcolor="#ffffff" style="padding: 10px 30px 40px 30px;">
       <table border="0" cellpadding="0" cellspacing="0" width="100%">
      <tr>

       <td><h1>Hola! '.$destinatario.' </h1></td>
      </tr>
      <tr><td style="padding: 10px 0 2px 0;">'.$mensaje.'
      </td></tr>
    <tr>
       <td><table border="0" cellpadding="0" cellspacing="0" width="100%">
         <tr class="up">
         <td  >Nº </td>
           <td >'.$id_req .'</td>
         </tr>
         <tr class="down">
           <td  >  Fecha de entrega :</td>
           <td >'.$fechareq .'</td>
         </tr>
         <tr class="up">
           <td>Nota :</td>
           <td>'.$nota.'</td>
         </tr>
         <tr class="down" >
           <td >Cliente :</td>
           <td >'.validarCliente($cliente).'</td>
         </tr>
         <tr class="up">
           <td >Producto: </td>
           <td >'.validarProducto($producto).'</td>
         </tr>
      </table>
       </td>
      </tr>

       </table>
</br>
       <center>
       '.$linkorden.'
</center>
       </td>

    </tr>

    <tr  style="padding: 0px 0px 0px 0px;">
      <th><img src="https://s3-us-west-2.amazonaws.com/agencia-jaque/gestion/plantilla2-plataforma.jpg" border="5px" style="border-color:white" alt="">
  </th>
  </tr>
   </table>
 </td>
</tr>
 </table>
</body>
</html>';

return $html;
}
function validarplan($plan)
{
if ($plan==',' or $plan=="") {
  echo "no tiene plan asignado";
}else {
  $planes=explode(",",$plan);
  $contador=count($planes);
    for ($i=0; $i <$contador ; $i++) {
      if ($planes[$i]=='') {
        }else{
        $plan=DB::table('app_planes')->select('nombre_plan')->where('id_plan',$planes[$i])->take(1)->get();
        foreach ($plan as $value) {
          $nombre=$value->nombre_plan;
        }

        echo $nombre."</br>";
      }
    }
}

}
function validarperfil($id)
{
  $perfil=DB::table('users')->select('id_perfil')->where('id',$id)->take(1)->get();
  foreach ($perfil as  $value) {
    $perfilf=$value->id_perfil;
  }
  return $perfilf;
}
function validarclienterequerimiento($id,$caso)
{

  if ($caso==1) {
  $count=DB::table('app_requerimientos')->where('id_cliente',$id)->count();
  if ($count==0) {
    echo '<button  id="eliminarcl" name="eliminarcl" style="width:100%;margin-top:5px" class="btn btn-sm btn-danger">ELIMINAR</button>';
}
}elseif ($caso==2) {
  $count=DB::table('app_requerimientos')->where('id_producto',$id)->count();
  if ($count==0) {
    echo '<button  id="eliminarcl" name="eliminarproducto" style="width:100%;margin-top:5px" class="btn btn-sm btn-danger">ELIMINAR</button>';
  }
}elseif ($caso==3) {
  $count=DB::table('app_clientes')->select('id_plan')->get();
  foreach ($count as $value) {
    $plan=$value->id_plan;

    $confirm= strpos($plan, (string)$id);
    if ($confirm === false) {

    }else {
      return "";
    }
  }
    echo '<button  id="eliminaplan" name="eliminarplan" style="width:100%;margin-top:5px" class="btn btn-sm btn-danger">ELIMINAR</button>';

}
}
function validardivision($id)
{
$id_tipo_lista=3;
$producto=DB::table('app_listas')->select('item_lista')->where('id_tipo_lista',$id_tipo_lista)->where('valor_lista',$id)->take(1)->get();
foreach ($producto as $value) {
  $division=$value->item_lista;
}
return $division;
}
function validarproductosplan($productos){
  if ($productos==',' or $productos=='') {
    echo "no tiene productos asignado";
  }
  $productos=explode(",",$productos);
  $contador=count($productos);
    for ($i=0; $i <$contador ; $i++) {
      if ($productos[$i]=='') {
        }else{
        $producto=DB::table('app_productos')->select('nombre_producto')->where('id_producto',$productos[$i])->take(1)->get();
        foreach ($producto as $value) {
          $nombre=$value->nombre_producto;
        }

  echo $nombre."</br>";
      }
    }

}
function fecha($fecha)
{
$fecha=Carbon::parse($fecha);
$anho=$fecha->year;
$mes=$fecha->month;
$dia=$fecha->day;
$hora=$fecha->hour;
$minutos=$fecha->minute;
$indicador='AM';
if ($hora>12) {
  $hora=$hora-12;
  $indicador='PM';
}
if ($hora==0) {
  $hora =12;
  $indicador='AM';
}
$fecha=$mes."/".$dia."/".$anho." ".$hora.":".$minutos.":00 ".$indicador;
return $fecha;

}
function fotoperfil($id)
{
  $usuario = DB::table('users')->select('link_perfil')->where('id',$id)->take(1)->get();
    foreach ($usuario as $value) {
      $user=$value->link_perfil;
    }
    if (empty($user)) {
      $user="";
    }
return $user;
}
function send_notification($registatoin_ids, $message) {
        // variable post http://developer.android.com/google/gcm/http.html#auth
        $url = 'https://android.googleapis.com/gcm/send';
        $fields = array(
            'registration_ids' => $registatoin_ids,
            'data' => $message,
        );
        $headers = array(
            'Authorization: key=AIzaSyCwElAWbpdWPNuJ58s_eITvjEGQrYwlpHM',
            'Content-Type: application/json'
        );
        // abriendo la conexion
        $ch = curl_init();
        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Deshabilitamos soporte de certificado SSL temporalmente
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        // ejecutamos el post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        // Cerramos la conexion
        curl_close($ch);
        echo $result;
    }

    function enviar_mensaje($regId, $message)
    {
      $registatoin_ids = array($regId);
      $mensaje = array(
      'message'     => $message, //mensaje a enviar
      'title'      => 'PushNotification',// Titulo de la notificación
      'msgcnt'    => '3',/*Número que sirve para informar cantidad de mensajes o eventos.
                 Se muestra en la parte derecha de la notificación
              (En Android 2.3.6 no me lo muestra, me imagino que debe depender de la versión)*/
            //'soundname'  => 'sonido.wav',//Sonido a reproducir *debe estar en la carpeta raíz
            //'collapseKey' => 'demo',
      /*Texto que sirve para colapsar las notificaciones cuando el dispositivo esta offline.
      Esto detecta si el dispositivo estaba sin acceso a red,
      de tal manera que una vez este en línea no le lleguen un montón
      de notificaciones al tiempo; solo llegará la última de cada notificación
      que tenga el mismo collapseKey*/
    'timeToLive' => 3000,/* Tiempo en segundos para mantener la notificación en GMC
                y volver a intentar el envío de esta.
                Default 4 semanas (2,419,200 segundos) si no es especificado.*/
    //'delayWhileIdle' => true, //Default is false
    //Mas opciones en http://developer.android.com/google/gcm/server.html#params
    );

      $result = send_notification($registatoin_ids, $mensaje);
      echo $result;
  }
