<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.2/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers;
use DB;
use App\Http\Requests;
use Illuminate\Http\Request;
use View;
use Carbon\Carbon;
use Auth;
use OneSignal;
/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
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

      $idusuario = Auth::user()->id;
      $idperfil = Auth::user()->id_perfil;
//    return OneSignal::createPlayer(['device_type' => 5,'player_id'=>'0183cbef-b48a-4a07-9af9-c189a228a310']);
//  OneSignal::editPlayer(['id'=>'0183cbef-b48a-4a07-9af9-c189a228a310']);

  $prioridad=DB::table('app_requerimientos')->where('id_usuario',$idusuario)->get();
  $fechahoy = Carbon::now();
  $dias_anho=($fechahoy->dayOfYear)*24;
  $horasdia=($fechahoy->hour);

  foreach ($prioridad as $value) {
    $fechareq=$value->fecha_limite_requerimiento;
    $fechareq=Carbon::parse($fechareq);
    $dias_req=($fechareq->dayOfYear)*24;
    $horasreq=($fechareq->hour);
    $horas_faltantes=($dias_req+$horasreq)-($dias_anho+$horasdia);
    if ($horas_faltantes > 48) {
      DB::table('app_requerimientos')->where('id_requerimiento',$value->id_requerimiento)->update(['tiempo_para_entrega'=>$horas_faltantes,'prioridad_requerimiento'=>3]);
    }elseif ($horas_faltantes <= 48 & $horas_faltantes >24 ) {
      DB::table('app_requerimientos')->where('id_requerimiento',$value->id_requerimiento)->
      update(['tiempo_para_entrega'=>$horas_faltantes,'prioridad_requerimiento'=>2]);
    }elseif ($horas_faltantes <= 24) {
      DB::table('app_requerimientos')->where('id_requerimiento',$value->id_requerimiento)->
      update(['tiempo_para_entrega'=>$horas_faltantes,'prioridad_requerimiento'=>1]);
    }
  }
  $requerimientos=DB::table('app_requerimientos')->orderBy('fecha_limite_requerimiento','asc')->where('id_usuario',$idusuario)->orwhere('aprobadopor',$idusuario)->orwhere('id_operador')->get();
  $mistareas=DB::table('app_requerimientos')->orderBy('fecha_limite_requerimiento','asc')->where('id_operador',$idusuario)->whereIn('estado_requerimiento',[1,2,3])->get();
  $contadores[]= DB::table('app_requerimientos')->where('estado_requerimiento',1)->where('id_usuario',$idusuario)->count();
  $contadores[]= DB::table('app_requerimientos')->where('estado_requerimiento',1)->where('id_operador',$idusuario)->count();
  $contadores[]= DB::table('app_requerimientos')->where('estado_requerimiento',2)->where('id_usuario',$idusuario)->count() + DB::table('app_requerimientos')->where('estado_requerimiento',3)->where('id_usuario',$idusuario)->count();
  if ($idperfil==1 or $idperfil==2) {
    $contadores[]= DB::table('app_requerimientos')->where('estado_requerimiento',4)->where('aprobadopor',$idusuario)->count();
  }else {
  $contadores[]= DB::table('app_requerimientos')->where('estado_requerimiento',6)->where('id_operador',$idusuario)->count();
  }


  return View::make("home")->with(array('requerimientos'=>$requerimientos,'contadores'=>$contadores,'mistareas'=>$mistareas,'mensajes'=>'0'));





    }
    public function admin()
        {
        $prioridad=DB::table('app_requerimientos')->get();
      $fechahoy = Carbon::now();
      $dias_anho=($fechahoy->dayOfYear)*24;
      $horasdia=($fechahoy->hour);

      foreach ($prioridad as $value) {
        $fechareq=$value->fecha_limite_requerimiento;
        $fechareq=Carbon::parse($fechareq);
        $dias_req=($fechareq->dayOfYear)*24;
        $horasreq=($fechareq->hour);
        $horas_faltantes=($dias_req+$horasreq)-($dias_anho+$horasdia);
        if ($horas_faltantes > 48) {
          DB::table('app_requerimientos')->where('id_requerimiento',$value->id_requerimiento)->update(['tiempo_para_entrega'=>$horas_faltantes,'prioridad_requerimiento'=>3]);
        }elseif ($horas_faltantes <= 48 & $horas_faltantes >24 ) {
          DB::table('app_requerimientos')->where('id_requerimiento',$value->id_requerimiento)->
          update(['tiempo_para_entrega'=>$horas_faltantes,'prioridad_requerimiento'=>2]);
        }elseif ($horas_faltantes <= 24) {
          DB::table('app_requerimientos')->where('id_requerimiento',$value->id_requerimiento)->
          update(['tiempo_para_entrega'=>$horas_faltantes,'prioridad_requerimiento'=>1]);
        }
      }
      $requerimientos=DB::table('app_requerimientos')->orderBy('fecha_limite_requerimiento','asc')->get();
      $contadores[]= DB::table('app_requerimientos')->whereIn('estado_requerimiento',[1,6])->count();
      $contadores[]= DB::table('app_requerimientos')->where('estado_requerimiento',2)->count() + DB::table('app_requerimientos')->where('estado_requerimiento',3)->count();
      $contadores[]= DB::table('app_requerimientos')->where('estado_requerimiento',4)->count();
      return View::make("admin")->with(array('requerimientos'=>$requerimientos,'contadores'=>$contadores));



        }



    public function realizarpedido()
    {
        Carbon::setLocale('es');
        $fechahoy = Carbon::now();
        $fechahoy=$fechahoy->format('l jS \\of F Y h:i:s A');
        $clientes =DB::table('app_clientes')->orderBy('nombre_cliente','asc')->get();
        $productos=DB::table('app_productos')->orderBy('nombre_producto','asc')->get();
        $users=DB::table('users')->orderBy('name','asc')->get();
        return View::make("pedido-form")->with(array('clientes'=>$clientes,'productos'=>$productos,
        'fechahoy'=>$fechahoy,'users'=>$users));
    }

    public function update()
    {
      $idusuario = Auth::user()->id;
      $idperfil = Auth::user()->id_perfil;
      $id=$_GET['id'];

      if ($id==1) {
      $prioridad=DB::table('app_requerimientos')->where('id_usuario',$idusuario)->get();
      }elseif ($id==2) {
      $prioridad=DB::table('app_requerimientos')->where('id_operador',$idusuario)->whereIn('estado_requerimiento',[1,2,3])->orderBy('fecha_limite_requerimiento','asc')->get();
      }elseif ($id==3) {
      $prioridad=DB::table('app_requerimientos')->where('id_usuario',$idusuario)->whereIn('estado_requerimiento',[2,3])->orderBy('fecha_limite_requerimiento','asc')->get();
      }elseif ($id==4) {
      if ($idperfil==1 or $idperfil==2) {
      $prioridad=DB::table('app_requerimientos')->where('aprobadopor',$idusuario)->where('estado_requerimiento',4)->orderBy('fecha_limite_requerimiento','asc')->get();
      }else {
      $prioridad=DB::table('app_requerimientos')->where('id_operador',$idusuario)->where('estado_requerimiento',4)->orderBy('fecha_limite_requerimiento','asc')->get();
      }
      }elseif ($id==5) {


      if ($idperfil==1 or $idperfil==2) {
      $prioridad=DB::table('app_requerimientos')->where('aprobadopor',$idusuario)->where('estado_requerimiento',6)->get();
      }else {
      $prioridad=DB::table('app_requerimientos')->where('id_operador',$idusuario)->whereIn('estado_requerimiento',6)->get();
      }
      }elseif ($id==6) {
      if ($idperfil==1 or $idperfil==2) {
      $prioridad=DB::table('app_requerimientos')->where('aprobadopor',$idusuario)->where('estado_requerimiento',5)->get();
    }else {
    $prioridad=DB::table('app_requerimientos')->where('id_operador',$idusuario)->whereIn('estado_requerimiento',5)->get();
    }
    }
        $fechahoy = Carbon::now();
        $dias_anho=($fechahoy->dayOfYear)*24;
        $horasdia=($fechahoy->hour);
        foreach ($prioridad as $value) {
          $fechareq=$value->fecha_limite_requerimiento;
          $fechareq=Carbon::parse($fechareq);
          $dias_req=($fechareq->dayOfYear)*24;
          $horasreq=($fechareq->hour);
          $horas_faltantes=($dias_req+$horasreq)-($dias_anho+$horasdia);
          if ($horas_faltantes > 48) {
            DB::table('app_requerimientos')->where('id_requerimiento',$value->id_requerimiento)->update(['tiempo_para_entrega'=>$horas_faltantes,'prioridad_requerimiento'=>3]);
          }elseif ($horas_faltantes <= 48 & $horas_faltantes >24 ) {
            DB::table('app_requerimientos')->where('id_requerimiento',$value->id_requerimiento)->
            update(['tiempo_para_entrega'=>$horas_faltantes,'prioridad_requerimiento'=>2]);
          }elseif ($horas_faltantes <= 24) {
            DB::table('app_requerimientos')->where('id_requerimiento',$value->id_requerimiento)->
            update(['tiempo_para_entrega'=>$horas_faltantes,'prioridad_requerimiento'=>1]);
          }
        }
        $requerimientos=DB::table('app_requerimientos')->orderBy('fecha_limite_requerimiento','asc')->where('id_usuario',$idusuario)->orderBy('fecha_limite_requerimiento','asc')->get();
        $mistareas=DB::table('app_requerimientos')->orderBy('fecha_limite_requerimiento','asc')->where('id_operador',$idusuario)->where('estado_requerimiento',[1,2,3])->orderBy('fecha_limite_requerimiento','asc')->get();
        if ($id==1) {
        $requerimientos=DB::table('app_requerimientos')->orderBy('fecha_limite_requerimiento','asc')->where('id_usuario',$idusuario)->orderBy('fecha_limite_requerimiento','asc')->get();
        return View::make("layouts.partials.tablas.tabla")->with(array('requerimientos'=>$requerimientos));
        }elseif ($id==2) {
        $mistareas=DB::table('app_requerimientos')->where('id_operador',$idusuario)->whereIn('estado_requerimiento',[1,2,3])->orderBy('fecha_limite_requerimiento','asc')->get();
        return View::make("layouts.partials.tablas.tablamistareas")->with(array('mistareas'=>$mistareas));
        }elseif ($id==3) {
        $requerimientos=DB::table('app_requerimientos')->whereIn('estado_requerimiento',[2,3])->where('id_usuario',$idusuario)->orderBy('fecha_limite_requerimiento','asc')->get();
        return View::make("layouts.partials.tablas.tablaenproceso")->with(array('requerimientos'=>$requerimientos));
        }elseif ($id==4) {
          if ($idperfil==1 or $idperfil==2) {
            $requerimientos=DB::table('app_requerimientos')->where('estado_requerimiento',4)->where('aprobadopor',$idusuario)->orderBy('fecha_limite_requerimiento','asc')->get();
          }else {
            $requerimientos=DB::table('app_requerimientos')->where('estado_requerimiento',4)->where('id_operador',$idusuario)->orderBy('fecha_limite_requerimiento','asc')->get();
          }
          return View::make("layouts.partials.tablas.tablaporaprobar")->with(array('requerimientos'=>$requerimientos));
        }elseif ($id==5) {
          if ($idperfil==1) {
            $requerimientos=DB::table('app_requerimientos')->where('estado_requerimiento',6)->where('aprobadopor',$idusuario)->orderBy('fecha_limite_requerimiento','asc')->get();
          }else {
            $requerimientos=DB::table('app_requerimientos')->where('estado_requerimiento',6)->where('id_operador',$idusuario)->orderBy('fecha_limite_requerimiento','asc')->get();
          }
          return View::make("layouts.partials.tablas.tabladevolucion")->with(array('requerimientos'=>$requerimientos));
        }elseif ($id==6) {
          if ($idperfil==1) {
            $requerimientos=DB::table('app_requerimientos')->where('estado_requerimiento',5)->where('aprobadopor',$idusuario)->orderBy('fecha_limite_requerimiento','asc')->get();
          }else {
            $requerimientos=DB::table('app_requerimientos')->where('estado_requerimiento',5)->where('id_operador',$idusuario)->orderBy('fecha_limite_requerimiento','asc')->get();
          }
          return View::make("layouts.partials.tablas.tablaaprobado")->with(array('requerimientos'=>$requerimientos));
        }


    }
    public function contador()
    {
      $id=$_GET['id'];
      $idusuario=auth::user()->id;
      $idperfil=auth::user()->id_perfil;
      if ($id==0) {
      $contador= DB::table('app_requerimientos')->where('estado_requerimiento',1)->where('id_usuario',$idusuario)->count();
      return $contador;
    }elseif ($id==1) {
      $contador= DB::table('app_requerimientos')->where('estado_requerimiento',1)->where('id_operador',$idusuario)->count();
      return $contador;
    }elseif ($id==2) {
          $contador= DB::table('app_requerimientos')->whereIn('estado_requerimiento',[2,3])->where('id_usuario',$idusuario)->count();
      return $contador;
    }elseif ($id==3) {
        if ($idperfil==1 or $idperfil==2) {
        $contador= DB::table('app_requerimientos')->where('estado_requerimiento',4)->where('aprobadopor',$idusuario)->count();
        return $contador;
        }else {
        $contador= DB::table('app_requerimientos')->where('estado_requerimiento',6)->where('id_operador',$idusuario)->count();
        return $contador;
        }
      }
    }
    public function adminupdate()
    {
      $idusuario = Auth::user()->id;
      $idperfil = Auth::user()->id_perfil;
      $id=$_GET['id'];


      if ($id==1) {
      $prioridad=DB::table('app_requerimientos')->where('estado_requerimiento',1)->get();
      }elseif ($id==2) {
      $prioridad=DB::table('app_requerimientos')->whereIn('estado_requerimiento',[2,3])->get();
      }elseif ($id==3) {
      $prioridad=DB::table('app_requerimientos')->where('estado_requerimiento',4)->get();
      }elseif ($id==4) {
      $prioridad=DB::table('app_requerimientos')->where('estado_requerimiento',6)->get();
      }elseif ($id==5) {
      $prioridad=DB::table('app_requerimientos')->where('estado_requerimiento',5)->get();
    }

        $fechahoy = Carbon::now();
        $dias_anho=($fechahoy->dayOfYear)*24;
        $horasdia=($fechahoy->hour);

        foreach ($prioridad as $value) {
          $fechareq=$value->fecha_limite_requerimiento;
          $fechareq=Carbon::parse($fechareq);
          $dias_req=($fechareq->dayOfYear)*24;
          $horasreq=($fechareq->hour);
          $horas_faltantes=($dias_req+$horasreq)-($dias_anho+$horasdia);
          if ($horas_faltantes > 48) {
            DB::table('app_requerimientos')->where('id_requerimiento',$value->id_requerimiento)->update(['tiempo_para_entrega'=>$horas_faltantes,'prioridad_requerimiento'=>3]);
          }elseif ($horas_faltantes <= 48 & $horas_faltantes >24 ) {
            DB::table('app_requerimientos')->where('id_requerimiento',$value->id_requerimiento)->
            update(['tiempo_para_entrega'=>$horas_faltantes,'prioridad_requerimiento'=>2]);
          }elseif ($horas_faltantes <= 24) {
            DB::table('app_requerimientos')->where('id_requerimiento',$value->id_requerimiento)->
            update(['tiempo_para_entrega'=>$horas_faltantes,'prioridad_requerimiento'=>1]);
          }
        }
        if ($id==1) {
        $requerimientos=DB::table('app_requerimientos')->orderBy('fecha_limite_requerimiento','asc')->get();
        return View::make("layouts.partials.tablas.tabla")->with(array('requerimientos'=>$requerimientos));
        }elseif ($id==2) {
        $requerimientos=DB::table('app_requerimientos')->whereIn('estado_requerimiento',[2,3])->get();
        return View::make("layouts.partials.tablas.tablaenproceso")->with(array('requerimientos'=>$requerimientos));
      }elseif ($id==3) {
          $requerimientos=DB::table('app_requerimientos')->where('estado_requerimiento',4)->get();
          return View::make("layouts.partials.tablas.tablaporaprobar")->with(array('requerimientos'=>$requerimientos));
        }elseif ($id==4) {
          $requerimientos=DB::table('app_requerimientos')->where('estado_requerimiento',6)->get();
          return View::make("layouts.partials.tablas.tabladevolucion")->with(array('requerimientos'=>$requerimientos));
        }elseif ($id==5) {
          $requerimientos=DB::table('app_requerimientos')->where('estado_requerimiento',5)->get();
          return View::make("layouts.partials.tablas.tablaaprobado")->with(array('requerimientos'=>$requerimientos));
        }

    }
    public function admincontador()
    {
      $id=$_GET['id'];
      $idusuario=auth::user()->id;
      $idperfil=auth::user()->id_perfil;
      if ($id==0) {
      $contador= DB::table('app_requerimientos')->whereIn('estado_requerimiento',[1,6])->count();
      return $contador;
    }elseif ($id==1) {
      $contador= DB::table('app_requerimientos')->whereIn('estado_requerimiento',[2,3])->count();
      return $contador;
    }elseif ($id==2) {
    $contador= DB::table('app_requerimientos')->whereIn('estado_requerimiento',[4])->count();
    return $contador;
    }
    }



}
