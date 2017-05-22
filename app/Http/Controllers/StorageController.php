<?php

namespace App\Http\Controllers;

use Storage;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests;
use Auth;
use DB;
use File;
use Redirect;
use Mail;
use Session;
use Sendinblue\Mailin;
use Webup\LaravelSendinBlue\SendinBlueTransport;
use Illuminate\Contracts\Filesystem\Filesystem;
//use Flysystem;

class StorageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function process(Request $request)
    {
    $tiempotrabajado=0;
    $fechahoy = Carbon::now();
    $todo=$request->all();
    $idrequerimiento=$todo['id_requerimiento'];
    $linkabjuntos='';
    if ($request->has('links')) {
      $linkabjuntos=$todo['links'];
    }
    $estado=$todo['estado_requerimiento'];
    $reques =DB::table('app_requerimientos')->where('id_requerimiento', $idrequerimiento )->take(1)->get();

    foreach ($reques as $value) {
    $link_=$value->trabajo_realizado;
    $usuario_requiere=$value->id_usuario;
    $usuarioexigido=$value->id_operador;
    $fechareq=$value->fecha_limite_requerimiento;
    $nota=$value->nota_requerimiento;
    $cliente=$value->id_cliente;
    $producto=$value->id_producto;
    $aprueba=$value->aprobadopor;
    }
    if (isset($todo['aceptar'])) {
      if ($estado==1) {//pendiente
        $tareasenproceso= DB::table('app_requerimientos')->where('estado_requerimiento',2)->where('id_operador',Auth::user()->id)->count();
        if ($tareasenproceso>0) {
        Session::flash('flash_message_noacepta', 'Tiene una orden en proceso, terminela para poder aceptar una nueva orden.');
        return back();
        }
        $estado=2;   //cambia estado a aceptado y en proceso
        $comentario='Aceptado y en proceso';
      }elseif($estado==2) {
        $seguimientos=DB::table('app_seguimientos')->where('id_requerimiento',$idrequerimiento)
        ->where('estado_requerimiento',$estado)->orderBy('fecha_seguimiento','asc')->take(1)->get();
        foreach ($seguimientos as $value) {
          $fecha_inicio=$value->fecha_seguimiento;
          $tiempoanterior=$value->tiempo_trabajado;
        }
        $files= $request->file('kartik-input-700');

        if (!($request->hasfile('kartik-input-700'))) {

        }else {
          foreach ($files as  $file) {
            $imageFileName = mt_rand(1,21474) . '.' . $file->getClientOriginalExtension();
            $s3 = \Storage::disk('s3');
            $filePath = '/'.$idrequerimiento.'/' . $imageFileName;
            $s3->put($filePath, file_get_contents($file), 'public');
            $link_req[]='https://s3-us-west-2.amazonaws.com/agencia-jaque'.$filePath;
          }

          $link_=$linkabjuntos.",".$link_.",".$link_req[0];
          $contador=count($link_req);
          for ($i=1; $i <$contador; $i++) {
            $link_=$link_.','.$link_req[$i];
          }

        }
        $estado= 3; //detenido
        $comentario='detenido';
        $fechainicio=Carbon::parse($fecha_inicio);
        $dias_anho=($fechahoy->dayOfYear)*86400;
        $dias_ini=($fechainicio->dayOfYear)*86400;
        $horasdia=($fechahoy->hour)*3600;
        $horasinicio=($fechainicio->hour)*3600;
        $prioridad=($dias_anho+$horasdia)-($dias_ini+$horasinicio);
        $tiempotrabajado=$prioridad/3600;
        $tiempo=validartiempotrabajado($fechainicio);
        $tiempotrabajado=$tiempo+$tiempoanterior;

    }elseif ($estado==3) {
      $seguimientos=DB::table('app_seguimientos')->where('id_requerimiento',$idrequerimiento)
      ->where('estado_requerimiento',$estado)->orderBy('fecha_seguimiento','desc')->take(1)->get();
      foreach ($seguimientos as $value) {
        $tiempoanterior=$value->tiempo_trabajado;
      }
      $tiempotrabajado=$tiempoanterior;
      $files= $request->file('kartik-input-700');
      if (!($request->hasfile('kartik-input-700'))) {

      }else {
        foreach ($files as  $file) {
          $imageFileName = mt_rand(1,21479) . '.' . $file->getClientOriginalExtension();
          $s3 = \Storage::disk('s3');
          $filePath = '/'.$idrequerimiento.'/' . $imageFileName;
          $s3->put($filePath, file_get_contents($file), 'public');
          $link_req[]='https://s3-us-west-2.amazonaws.com/agencia-jaque'.$filePath;
        }
        $link_=$linkabjuntos.",".$link_.",".$link_req[0];
        $contador=count($link_req);
        for ($i=1; $i <$contador; $i++) {
          $link_=$link_.','.$link_req[$i];
        }
      }
      $estado=2;//en proceso
      $comentario='retoma la peticion y en proceso';
    }elseif ($estado==4) {
      $estado=5;//aprobado
      $caso=6;//caso aprovado
      $usuariodestino = DB::table('users')->where('id',$usuario_requiere)->take(1)->get();
      foreach ($usuariodestino as $value) {
        $email_destino=$value->email;
        $para=$value->name;
      }
      DB::table('app_emails')->insert([
      ['de'=>Auth::user()->name,'para'=>$para,'caso'=>$caso,'to'=> $email_destino,
      'id_req'=> $idrequerimiento,'replytoemail'=>Auth::user()->email,
      'replytoname'=> Auth::user()->name,'estado'=>0,'comentario'=>'Han terminado y aprovado la orden que requeriste' ]]);

      if ($request->has('comentario')) {
        $comentario=$request->comentario;
      }else {
        $comentario='Aprovado por el area encargada';
      }
    }elseif ($estado==6) {
      $estado=2;
      if ($request->has('comentario')) {
        $comentario=$request->comentario;
      }else {
        $comentario='Aceptado por el operador';
      }

    }elseif ($estado==7) {//si esta en revision y se modifican los respectivos cambios
      $estado=1;
      if ($request->has('comentario')) {
        $comentario=$request->comentario;
      }else {
        $comentario='revisado y modificado';
      }

      $caso=3;//caso coregido
      $userm = DB::table('users')->where('id',$usuarioexigido)->take(1)->get();
      foreach ($userm as $value) {
        $email_destino=$value->email;
        $para=$value->name;
      }
      DB::table('app_emails')->insert([
      ['de'=>Auth::user()->name,'para'=>$para,'caso'=>$caso,'to'=> $email_destino,
      'id_req'=> $idrequerimiento,'replytoemail'=>Auth::user()->email,
      'replytoname'=> Auth::user()->name,'estado'=>0,'comentario'=>$comentario ]]);

    }
  }else {
    if ($estado==1) {//pendiente pero necesita revision
      $estado=7;   //cambia estado a pendiente por revision por el area que envia elpedido
      if ($request->has('comentario')) {
        $comentario=$request->comentario;
      }else {
        $comentario='necesita revision por parte del area que requiere el pedido';
      }
      $caso=2;//devolver a usuario
      $userm = DB::table('users')->where('id',$usuario_requiere)->take(1)->get();
      foreach ($userm as $value) {
        $email_destino=$value->email;
        $para=$value->name;
      }
      DB::table('app_emails')->insert([
      ['de'=>Auth::user()->name,'para'=>$para,'caso'=>$caso,'to'=> $email_destino,
      'id_req'=> $idrequerimiento,'replytoemail'=>Auth::user()->email,
      'replytoname'=> Auth::user()->name,'estado'=>0,'comentario'=>$comentario ]]);

    }elseif ($estado==2 or $estado==3) {
      $seguimientos=DB::table('app_seguimientos')->where('id_requerimiento',$idrequerimiento)
      ->where('estado_requerimiento',$estado)->orderBy('fecha_seguimiento','asc')->take(1)->get();
      foreach ($seguimientos as $value) {
        $fecha_inicio=$value->fecha_seguimiento;
        $tiempoanterior=$value->tiempo_trabajado;
      }
      $linkabjuntos=$todo['link'];
      $requerimientos =DB::table('app_requerimientos')->select('link_adjunto_requerimiento')
      ->where('id_requerimiento', $idrequerimiento )->take(1)->get();
      foreach ($requerimientos as $value) {
        $link_=$value->link_adjunto_requerimiento;
      }
      if (empty($link_)) {
        $link_="";
      }
            for ($i=1; $i < 7 ; $i++) {
              if ($request->has('link'.$i)) {
                if (!empty($todo['link'.$i])) {
                $linkabjuntos=$linkabjuntos.",".$todo['link'.$i];
              }
              }
            }
            if (!($request->hasfile('kartik-input-700'))) {
              $link_req[]=",";
            }else {
              $files=$todo['kartik-input-700'];
            foreach ($files as  $file) {
              $imageFileName = mt_rand(1,21477) . '.' . $file->getClientOriginalExtension();
              $s3 = \Storage::disk('s3');
              $filePath = '/'.$idrequerimiento.'/' . $imageFileName;
              $s3->put($filePath, file_get_contents($file), 'public');
              $link_req[]='https://s3-us-west-2.amazonaws.com/agencia-jaque'.$filePath;
            }
        }
          if (!empty($linkabjuntos)) {
            if ($link_req[0]==",") {
              $link_=$link_.",".$linkabjuntos;
            }else {
              $link_=$link_.",".$linkabjuntos.",".$link_req[0];
            }

          }else {
              if ($link_req[0]==","){

              }else {
                $link_=$link_.",".$link_req[0];
                }
            }
            $contador=count($link_req);
            for ($i=1; $i <$contador; $i++) {
              $link_=$link_.','.$link_req[$i];
            }
      $estado=4;//aprobar
      if ($request->has('comentario')) {
        $comentario=$request->comentario;
      }else {
        $comentario='Terminado, esperando aprovacion del area encargada';
      }
      $fechainicio=Carbon::parse($fecha_inicio);
      $dias_anho=($fechahoy->dayOfYear)*86400;
      $dias_ini=($fechainicio->dayOfYear)*86400;
      $horasdia=($fechahoy->hour)*3600;
      $horasinicio=($fechainicio->hour)*3600;
      $prioridad=($dias_anho+$horasdia)-($dias_ini+$horasinicio);
      $tiempo=validartiempotrabajado($fechainicio);
      $tiempotrabajado=$tiempo+$tiempoanterior;
      $perfilusuario_requiere=validarperfil($usuario_requiere);

      $destinos=DB::table('users')->where('id',$aprueba)->take(1)->get();
      foreach ($destinos as $value) {
      $email_destino=$value->email;
      $para=$value->name;
      $idaprueba=$value->id;
      }
      $caso=4;//poraprobar
      DB::table('app_emails')->insert([
      ['de'=>Auth::user()->name,'para'=>$para,'caso'=>$caso,'to'=> $email_destino,
      'id_req'=> $idrequerimiento,'replytoemail'=>Auth::user()->email,
      'replytoname'=> Auth::user()->name,'estado'=>0,'comentario'=>$comentario ]]);


  }elseif ($estado==4) {
  $estado=6;//devolucion
if ($request->has('comentario')) {
$comentario=$request->comentario;
}else {
  $comentario='devuelto por el area encargada';
}
  $destinos=DB::table('users')->where('id',$usuarioexigido)->get();
  foreach ($destinos as $value) {
  $email_destino=$value->email;
  $para=$value->name;
  }
  $caso=5;//en devolucion
  DB::table('app_emails')->insert([
  ['de'=>Auth::user()->name,'para'=>$para,'caso'=>$caso,'to'=> $email_destino,
  'id_req'=> $idrequerimiento,'replytoemail'=>Auth::user()->email,
  'replytoname'=> Auth::user()->name,'estado'=>0,'comentario'=>$comentario ]]);
}
}
DB::table('app_requerimientos')
      ->where('id_requerimiento', $idrequerimiento)
      ->update(['estado_requerimiento' => $estado,'trabajo_realizado' => $link_]);

DB::table('app_seguimientos')->insert([
['id_requerimiento'=>$idrequerimiento,'id_usuario'=> Auth::user()->id, 'fecha_seguimiento'=> $fechahoy,
 'comentario_seguimiento'=> $comentario,
 'estado_requerimiento'=> $estado, 'tiempo_trabajado'=>$tiempotrabajado]
 ]);
return back();

}

    public function update(Request $request){
      $todo=$request->all();
      $idrequerimiento=$todo['id_requerimiento'];
      $files= $request->file('kartik-input-700');
      $idusuario=$request["id_usuario"];

      $f = $request->input("Fecha_limite_de_entrega");
      $num=strlen($f);
      if ($num==18) {
      $h2=substr($f,16,2);
      $h="0".substr($f,11,4).":00";
      if ($h2=='PM') {
      $horas12=(int)substr($f,11,1);
      $horas12=$horas12+12;
      $h=$horas12.substr($f,12,3).":00";
      }
      }elseif($num==19){
        $h2=substr($f,17,2);
        $h=substr($f,11,5).":00";
        if ($h2=='PM'){
        $horas12=(int)substr($f,11,2);
        $horas12=$horas12+12;
        $h=$horas12.substr($f,13,3).":00";
        }
      }
      $m=substr($f,0,2);
      $d=substr($f,3,2);
      $y=substr($f,6,4);
      $fecha_req=$y."-".$m."-".$d." ".$h;
      $fecha_req=Carbon::parse($fecha_req);
      $f = $request->input("Fecha_de_orden");
      $num=strlen($f);
      if ($num==18) {
      $h2=substr($f,16,2);
      $h="0".substr($f,11,4).":00";
      if ($h2=='PM') {
      $horas12=(int)substr($f,11,1);
      $horas12=$horas12+12;
      $h=$horas12.substr($f,12,3).":00";
      }
      }elseif($num==19){
        $h2=substr($f,17,2);
        $h=substr($f,11,5).":00";
        if ($h2=='PM'){
        $horas12=(int)substr($f,11,2);
        $horas12=$horas12+12;
        $h=$horas12.substr($f,13,3).":00";
        }
      }
      $m=substr($f,0,2);
      $d=substr($f,3,2);
      $y=substr($f,6,4);
      $fecha_hoy=$y."-".$m."-".$d." ".$h;
      $fechaanterior=Carbon::parse($fecha_hoy);
        $fechahoy=Carbon::parse($fecha_hoy);

      $linkabjuntos=$todo['link'];
      for ($i=1; $i < 7 ; $i++) {
        if ($request->has('link'.$i)) {
          if (!empty($todo['link'.$i])) {
          $linkabjuntos=$linkabjuntos.",".$todo['link'.$i];
        }
        }
      }
      $requerimientos =DB::table('app_requerimientos')->select('link_adjunto_requerimiento')
      ->where('id_requerimiento', $idrequerimiento )->take(1)->get();
      foreach ($requerimientos as $value) {
        $link_=$value->link_adjunto_requerimiento;
      }
      if (!($request->hasfile('kartik-input-700'))) {
        $link_req[0]=",";
      }else {
        foreach ($files as  $file) {
          $imageFileName = mt_rand(1,21477) . '.' . $file->getClientOriginalExtension();
          $s3 = \Storage::disk('s3');
          $filePath = '/'.$idrequerimiento.'/' . $imageFileName;
          $s3->put($filePath, file_get_contents($file), 'public');
          $link_req[]='https://s3-us-west-2.amazonaws.com/agencia-jaque'.$filePath;
        }
      }
      if (!empty($linkabjuntos)) {
        if ($link_req[0]==",") {
          $link_=$link_.",".$linkabjuntos;
        }else {
          $link_=$linkabjuntos.",".$link_req[0];
        }

      }else {
          if ($link_req[0]==","){

          }else {
            $link_=$link_.",".$link_req[0];
            }
        }
        $contador=count($link_req);
        for ($i=1; $i <$contador; $i++) {
          $link_=$link_.','.$link_req[$i];
        }

      $requerimientos =DB::table('app_requerimientos')->select('estado_requerimiento')
      ->where('id_requerimiento', $idrequerimiento )->take(1)->get();
      foreach ($requerimientos as $value) {
        $estado_requerimiento=$value->estado_requerimiento;
      }
      $cliente =$todo['Cliente'];
      $nota =$todo['nota'];
      $producto = $todo['producto_id'];
      $fechareq=Carbon::parse($fecha_req);
      $dias_anho=($fechahoy->dayOfYear)*86400;
      $dias_req=($fechareq->dayOfYear)*86400;
      $horasdia=($fechahoy->hour)*3600;
      $horasreq=($fechareq->hour)*3600;
      $prioridad=($dias_req+$horasreq)-($dias_anho+$horasdia);
      $tiempoparaentrega=$prioridad/3600;
      if ($prioridad>=172800) {
        $prioridad=3; //PRIORIDAD NORMAL
      }elseif ($prioridad<=86400) {
        $prioridad=1;//'prioridad alta';
      }else {
        $prioridad=2;//'prioridad media';
      }
      DB::table('app_requerimientos')->where('id_requerimiento',$idrequerimiento)->
      update(['id_cliente'=>$cliente,'id_producto'=>$producto,'nota_requerimiento'=>$nota,
      'tiempo_para_entrega'=>$tiempoparaentrega,'id_operador'=>$todo['Operador'],
      'prioridad_requerimiento'=>$prioridad,'fecha_limite_requerimiento'=>$fecha_req,
    'fecha_requerimiento'=>$fechaanterior,'link_adjunto_requerimiento'=>$link_,'aprobadopor'=>$todo['aprobadopor']]);

      DB::table('app_seguimientos')->insert([
      ['id_requerimiento'=>$idrequerimiento,'id_usuario'=> $idusuario, 'fecha_seguimiento'=> Carbon::now()
      ,'estado_requerimiento'=> $estado_requerimiento, 'comentario_seguimiento'=>'se edito la peticion',
      'estado_actividad_seguimiento'=>0]
      ]);

return Redirect::to('show?id='.$idrequerimiento);

      }


    public function save(Request $request){
      ini_set('upload_max_filesize', '100M');
      ini_set('post_max_size', '100M');
      ini_set('memory_limit', '-1');
      ini_set('max_execution_time', 300);
      $todo=$request->all();
      $linkabjuntos=$todo['link'];
      for ($i=1; $i < 7 ; $i++) {
        if ($request->has('link'.$i)) {
          if (!empty($todo['link'.$i])) {
          $linkabjuntos=$linkabjuntos.",".$todo['link'.$i];
        }
        }
      }

      if ($request->has('anterior')) {
        $this->validate($request, [
          'Cliente' => 'required',
          'Producto' => 'required',
          'Operador' => 'required',
          'Aprobado_por' => 'required',
          'Fecha_limite_de_entrega' => 'required',
          'Fecha_de_orden' => 'required',]);
      }else {
        $this->validate($request, [
          'Cliente' => 'required',
          'Producto' => 'required',
          'Operador' => 'required',
          'Aprobado_por' => 'required',
          'Fecha_limite_de_entrega' => 'required',]);
      }
      $aprobadopor=$request['Aprobado_por'];
      $idusuario = Auth::user()->id;
      $cliente =$todo['Cliente'];
      $nota =$todo['nota_pedido'];
      $usuarioexigido =$todo['Operador'];
      $producto = $todo['Producto'];
      $f = $request->input("Fecha_limite_de_entrega");
      $num=strlen($f);
      if ($num==18) {
      $h2=substr($f,16,2);
      $h="0".substr($f,11,4).":00";
      if ($h2=='PM') {
      $horas12=(int)substr($f,11,1);
      $horas12=$horas12+12;
      $h=$horas12.substr($f,12,3).":00";
      }
      }elseif($num==19){
        $h2=substr($f,17,2);
        $h=substr($f,11,5).":00";
        if ($h2=='PM'){
        $horas12=(int)substr($f,11,2);
        $horas12=$horas12+12;
        $h=$horas12.substr($f,13,3).":00";
        }
      }
      $m=substr($f,0,2);
      $d=substr($f,3,2);
      $y=substr($f,6,4);
      $fecha_req=$y."-".$m."-".$d." ".$h;
      $fechareq=Carbon::parse($fecha_req);
      $fechahoy = Carbon::now();
      if ($request->has('anterior')) {
        $f = $request->input("Fecha_de_orden");
        $num=strlen($f);
        if ($num==18) {
        $h2=substr($f,16,2);
        $h="0".substr($f,11,4).":00";
        if ($h2=='PM') {
        $horas12=(int)substr($f,11,1);
        $horas12=$horas12+12;
        $h=$horas12.substr($f,12,3).":00";
        }
        }elseif($num==19){
          $h2=substr($f,17,2);
          $h=substr($f,11,5).":00";
          if ($h2=='PM'){
          $horas12=(int)substr($f,11,2);
          $horas12=$horas12+12;
          $h=$horas12.substr($f,13,3).":00";
          }
        }
        $m=substr($f,0,2);
        $d=substr($f,3,2);
        $y=substr($f,6,4);
        $fecha_hoy=$y."-".$m."-".$d." ".$h;
        $fechahoy=Carbon::parse($fecha_hoy);
        $fechahoy=Carbon::parse($fechahoy);
      }
      $dias_anho=($fechahoy->dayOfYear)*86400;
      $dias_req=($fechareq->dayOfYear)*86400;
      $horasdia=($fechahoy->hour)*3600;
      $horasreq=($fechareq->hour)*3600;
      $prioridad=($dias_req+$horasreq)-($dias_anho+$horasdia);
      $tiempoparaentrega=$prioridad/3600;
      if ($prioridad>=172800) {
        $prioridad=3; //PRIORIDAD NORMAL
      }elseif ($prioridad<=86400) {
        $prioridad=1;//'prioridad alta';
      }else {
        $prioridad=2;//'prioridad media';
      }
$id_req=DB::table('app_requerimientos')->max('id_requerimiento');
$id_req=$id_req+1;
  if (empty($id_req)){
    $id_req=1;
  }

$files= $request->file('kartik-input-700');
if (!($request->hasfile('kartik-input-700'))) {
    $link_req[]=",";
  }else {
  foreach ($files as  $file) {
            $imageFileName = mt_rand(1,21721) . '.' . $file->getClientOriginalExtension();
            $s3 = \Storage::disk('s3');
            $filePath = '/'.$id_req.'/' . $imageFileName;
            $s3->put($filePath, file_get_contents($file), 'public');
              $link_req[]='https://s3-us-west-2.amazonaws.com/agencia-jaque'.$filePath;
          }
}
if (!empty($linkabjuntos)) {
  if ($link_req[0]==",") {
    $link_=$linkabjuntos;
  }else {
    $link_=$linkabjuntos.",".$link_req[0];
  }

}else {
  $link_=$link_req[0];
  }
  $contador=count($link_req);
  for ($i=1; $i <$contador; $i++) {
    $link_=$link_.','.$link_req[$i];
  }
$userm = DB::table('users')->where('id',$usuarioexigido)->take(1)->get();
foreach ($userm as $value) {
  $email_destino=$value->email;
  $para=$value->name;
}

DB::table('app_requerimientos')->insert([
['id_requerimiento'=>$id_req,'id_usuario'=> $idusuario, 'fecha_requerimiento'=> $fechahoy,
'id_cliente'=>$cliente,'id_producto'=> $producto, 'fecha_limite_requerimiento'=>$fechareq,
'link_adjunto_requerimiento'=>$link_,'nota_requerimiento'=> $nota, 'prioridad_requerimiento'=>$prioridad,
'estado_requerimiento'=> 1, 'tiempo_para_entrega'=>$tiempoparaentrega,'trabajo_realizado'=>',',
'id_operador'=>$usuarioexigido,'aprobadopor'=>$aprobadopor]]);

DB::table('app_seguimientos')->insert([
['id_requerimiento'=>$id_req,'id_usuario'=> $idusuario, 'fecha_seguimiento'=> $fechahoy
,'estado_requerimiento'=> 1, 'comentario_seguimiento'=>'se crea peticion','estado_actividad_seguimiento'=>0]
]);

$caso=1;
DB::table('app_emails')->insert([
['de'=>Auth::user()->name,'para'=>$para,'caso'=>$caso,'to'=> $email_destino,
'id_req'=> $id_req,'replytoemail'=>Auth::user()->email,
'replytoname'=> Auth::user()->name,'estado'=>0,'comentario'=>'se Creo orden de trabajo' ]]);

return Redirect::action('VistasController@show', $enviar=array('id' => $id_req));
}

}
