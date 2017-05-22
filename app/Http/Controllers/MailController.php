<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Mail;
use Sendinblue\Mailin;
use Webup\LaravelSendinBlue\SendinBlueTransport;
use Illuminate\Contracts\Filesystem\Filesystem;
use App\Http\Requests;

class MailController extends Controller
{
    public function enviarcorreos(){
    $mailin = new Mailin('https://api.sendinblue.com/v2.0',env('SENDINBLUE_KEY'));
    $enviarcorreos =DB::table('app_emails')->where('estado', 0 )->get();
    foreach ($enviarcorreos as $correo) {
 	   	$caso=$correo->caso;
 	   	$to=$correo->to;
      $de=$correo->de;
      $para=$correo->para;
 	   	$id_req=$correo->id_req;
 	   	$replytoemail=$correo->replytoemail;
 	   	$replytoname=$correo->replytoname;
      $requerimiento =DB::table('app_requerimientos')->where('id_requerimiento', $id_req )->get();
foreach ($requerimiento as $datos) {
if ($caso==1) {
$msj1='NUEVA ORDEN Nº='.$id_req;
$msj2='NUEVA ORDEN Nº='.$id_req;
$msj3=$correo->comentario;

}elseif ($caso==2) {
  $msj1='REVISAR - ORDEN Nº='.$id_req;
  $msj2='REVISAR - ORDEN Nº='.$id_req;
  $msj3="REVISAR ORDEN DE TRABAJO";
}elseif ($caso==3) {
  $msj1='CORREGIR - ORDEN Nº='.$id_req;
  $msj2='CORREGIR - ORDEN Nº='.$id_req;
  $msj3=$correo->comentario;
}elseif ($caso==4) {
  $msj1='APROBAR - ORDEN Nº='.$id_req;
  $msj2='APROBAR - ORDEN Nº='.$id_req;
  $msj3=$correo->comentario;
}elseif ($caso==5) {
  $msj1='NO APROBADA - ORDEN Nº='.$id_req;
  $msj2='NO APROBADA - ORDEN Nº='.$id_req;
  $msj3=$correo->comentario;
 }
elseif ($caso==6) {
  $msj1='TRABAJO FINALIZADO - ORDEN  Nº='.$id_req;
  $msj2='TRABAJO FINALIZADO - ORDEN  Nº='.$id_req;

  $msj3=$correo->comentario;
 }

  $data = array( "to" => array($to=>"GESTION JAQUE"),
      "from" => array(env('MAIL_USERNAME'),$msj1),
      "replyto" => array($replytoemail, $de ),
      "subject" => $msj2,
      "html" =>correo($id_req, $correo->para , $datos->fecha_limite_requerimiento, $datos->nota_requerimiento, $datos->id_cliente, $datos->id_producto, $caso, $msj3 ,$correo->de ),
      "attachment" => array(),
      "headers" => array("Content-Type"=> "text/html; charset=iso-8859-1","X-param1"=> "value1", "X-param2"=> "value2","X-Mailin-custom"=>"my custom value", "X-Mailin-IP"=> "102.102.1.2", "X-Mailin-Tag" => "My tag"),
      "inline_image" => array('myinlineimage1.png' => "your_png_files_base64_encoded_chunk_data",'myinlineimage2.jpg' => "your_jpg_files_base64_encoded_chunk_data")
  );
$mailin->send_email($data);
DB::table('app_emails')
      ->where('id_email', $correo->id_email)
      ->update(['estado' => 1]);
      echo "correo enviado";
}
    }

    }
}
