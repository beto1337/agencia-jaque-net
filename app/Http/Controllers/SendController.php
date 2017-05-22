<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use View;
use Auth;
use Carbon\Carbon;

class SendController extends Controller
{
  public function registrar(Request $request)
  {
    $todo=$request->all();
    $email=$request->correo;
    $regId=$request->idreg;
    if(empty($regId)){
    return "Cierre y vuelva a abrir la aplicacion para poder registrar su movil";
    }
    $users=DB::table('users')->where('email',$email)->take(1)->get();
    foreach ($users as $value) {
      DB::table('users')->where('email',$value->email)->update(['gcm_regid' => $regId]);
    }
    if(empty($users)){
        return "el correo no coincide con nuestras bases de datos";
    }
    return "Dispositivo registrado correctamente";
  }
  public function notificacion()
  {
    $users = DB::table('users')->whereNotNull('gcm_regid')->get();

    return View::make('mails.notificacion')->with(array('users'=>$users));
  }
}
