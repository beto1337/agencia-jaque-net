<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use View;
use Auth;
use Carbon\Carbon;


class ChatController extends Controller
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
  public function index()
  {
  $usuarios = DB::table('users')->whereNotIn('id', [Auth::user()->id])->get();
  $mensajescon=DB::table('app_chat')->where('to',Auth::user()->id)->where('visto',0)->count();
  $mensajes=DB::table('app_chat')->where('to',Auth::user()->id)->orwhere('from',Auth::user()->id)->orderBy( 'fecha','asc')->groupBy('id_chat')->get();
  return View::make("chat")->with(array('mensajes'=>$mensajescon,'chat'=>$mensajes,'usuarios'=>$usuarios));
  }
  public function chat()
  {
  $usuarios = DB::table('users')->whereNotIn('id', [Auth::user()->id])->get();
  $mensajescon=DB::table('app_chat')->where('to',Auth::user()->id)->where('visto',0)->where('id_chat',$_GET['id'])->count();
  $mensajes=DB::table('app_chat')->where('id_chat',$_GET['id'])->orderBy( 'id','desc')->get();
  return View::make("mails.chat")->with(array('mensajes'=>$mensajes,'contador'=>$mensajescon,'usuarios'=>$usuarios,'mensajeid'=>$_GET['id']));
  }
  public function nuevomensaje(Request $request)
  {
    $m=DB::table('app_chat')->where('id_chat',$request->id_m)->take(1)->get();
    foreach ($m as $m) {
      if ($m->to==Auth::user()->id) {
        $recibe=$m->from;
      }else {
        $recibe=$m->to;
      }
    }
    DB::table('app_chat')->insert(
        ['from' =>Auth::user()->id, 'to' => $recibe,'id_chat'=>$request->id_m,'mensaje'=>$request->message,'visto'=>0,'fecha'=>Carbon::now()]
    );
  }
  public function actualizar()
  {
  $usuarios = DB::table('users')->whereNotIn('id', [Auth::user()->id])->get();
  $mensajescon=DB::table('app_chat')->where('to',Auth::user()->id)->where('visto',0)->where('id_chat',$_GET['id'])->count();
  DB::table('app_chat')->where('to',Auth::user()->id)->where('visto',0)->where('id_chat',$_GET['id'])->update(['visto' => 1]);
  $mensajes=DB::table('app_chat')->where('id_chat',$_GET['id'])->orderBy( 'fecha','asc')->get();
  return View::make("mails.nuevo")->with(array('mensajes'=>$mensajes,'contador'=>$mensajescon,'usuarios'=>$usuarios,'mensajeid'=>$_GET['id']));
  }
  public function newchat()
  {
  $usuarios = DB::table('users')->whereNotIn('id', [Auth::user()->id])->get();
  $mensajescon=DB::table('app_chat')->where([['to',$_GET['id']],['from',Auth::user()->id]])->orwhere([['from',$_GET['id']],['to',Auth::user()->id]])->count();
  if ($mensajescon==0) {
    $idm = DB::table('app_chat')->max('id_chat');
    $idm=$idm+1;
    DB::table('app_chat')->insert(
        ['from' =>Auth::user()->id, 'to' => $_GET['id'],'id_chat'=>$idm,'mensaje'=>'','visto'=>1,'fecha'=>Carbon::now()]
    );
  }
  else {
$mens=DB::table('app_chat')->where([['to',$_GET['id']],['from',Auth::user()->id]])->orwhere([['from',$_GET['id']],['to',Auth::user()->id]])->take(1)->get();
foreach ($mens as $value) {
$idm=$value->id_chat;
}
  }
  $mensajes=DB::table('app_chat')->where('id_chat',$idm)->orderBy( 'fecha','asc')->get();
  return View::make("mails.chat")->with(array('mensajes'=>$mensajes,'contador'=>$mensajescon,'usuarios'=>$usuarios,'mensajeid'=>$idm));
  }
  public function chatmsjs()
  {
  $mensajes=DB::table('app_chat')->where('to',Auth::user()->id)->orwhere('from',Auth::user()->id)->orderBy( 'fecha','asc')->groupBy('id_chat')->get();
  return View::make("mails.msjs")->with(array('chat'=>$mensajes));
  }
  public function contador()
    {
      $mensajescon=DB::table('app_chat')->where('to',Auth::user()->id)->where('visto',0)->count();
      $mensajesfinal=DB::table('app_chat')->where('to',Auth::user()->id)->orwhere('from',Auth::user()->id)->orderBy( 'id','desc')->groupBy('id_chat')->get();
      if ($mensajescon==0) {
        $msj='No tienes mensajes nuevos';
      }else {
        $msj='tienes '.$mensajescon.' mensajes nuevos';
        }
      return View::make('mails.notifications')->with(array('mensajesultimos'=>$mensajesfinal,'msj'=>$msj,'coun'=>$mensajescon));

}




}
