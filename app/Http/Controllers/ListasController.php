<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use Redirect;
use Session;
use View;

class ListasController extends Controller
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


public function indexproducto()
{
  return view('registro.productos');
}
public function registrarproducto(Request $request)
{
  $todo=$request->all();
  $nombre=$todo['nombreproducto'];
  $descripcion=$todo['descripcion'];
    DB::table('app_productos')->insert([['nombre_producto'=> $nombre, 'descripcion_producto'=> $descripcion]]);
    Session::flash('flash_message', 'Se ha registrado el producto exitosamente.');
    return Redirect::to('/');
}
public function buscarproducto()
{
$productos=DB::table('app_productos')->select('id_producto','nombre_producto')->orderBy('nombre_producto','asc')->get();
return View::make("buscar.producto")->with(array('productos'=>$productos));
}

public function verproducto()
{
$id=$_GET['id'];
$id;
$productos=DB::table('app_productos')->where('id_producto',$id)->get();
return View::make("buscar.tablaproducto")->with(array('productos'=>$productos));
}


public function formularioeditarproducto()
{
  $id=$_GET['id'];
  //return $id;
  $productos=DB::table('app_productos')->where('id_producto',$id)->take(1)->get();
  return View::make('buscar.editarproducto')->with(array('productos'=>$productos));
}
public function editarproducto(Request $request)
{
  $todo=$request->all();
  $id=$todo['productoid'];
  //return $todo;
  if (isset($todo['eliminarproducto'])) {
  DB::table('app_productos')->where('id_producto',$id)->delete();
Session::flash('delete_message', 'Se ha eliminado el cliene exitosamente.');
  }else {
    $nombre=$todo['nombre'];
    $descripcion=$todo['descripcion'];

    DB::table('app_productos')->where('id_producto',$id)->update(['nombre_producto'=> $nombre,
    'descripcion_producto'=> $descripcion]);
    Session::flash('flash_message', 'Se ha editado el producto exitosamente.');
    Session::flash('id', $id);
  }
  return back();

}
public function indexcliente()
{
  $planes=DB::table('app_planes')->get();

return View::make("registro.cliente")->with(array('planes'=>$planes));

}

public function buscarcliente()
{
$clientes=DB::table('app_clientes')->select('id_cliente','alias','nombre_cliente','apellido_cliente')->orderBy('nombre_cliente','asc')->get();
return View::make("buscar.cliente")->with(array('clientes'=>$clientes));
}

public function vercliente()
{
$id=$_GET['id'];
$id;
$clientes=DB::table('app_clientes')->where('id_cliente',$id)->get();
return View::make("buscar.tablacliente")->with(array('clientes'=>$clientes));
}


public function registrarcliente(Request $request)
{
  $todo=$request->all();
  //return $todo;
  if ($request->has('planes')) {
    $planes=$todo['planes'];
  $planes=implode(",", $planes);
}else {
  $planes=",";
}
$nombreartisticocl=$todo['nombreartistico_cl'];
$nombrecl=$todo['nombre_cl'];
$apellidocl=$todo['apellido_cl'];
$telefonocl=$todo['telefono_cl'];
$correocl=$todo['correo_cl'];
$celularcl=$todo['celular_cl'];
$whapcl=$todo['wha_cl'];
$facebook=$todo['facebook'];
$twitter=$todo['twitter'];
$instagram=$todo['instagram'];
$pinteres=$todo['pinteres'];
$google=$todo['google'];
$youtube=$todo['youtube'];

$nombreco=$todo['nombre_co'];
$apellidoco=$todo['apellido_co'];
$telefonoco=$todo['telefono_co'];
$correoco=$todo['correo_co'];
$celularco=$todo['celular_co'];
$whapco=$todo['wha_co'];
$files= $request->file('kartik-input-700');
$link_="";
if ($files==[null]) {
$link_='https://s3-us-west-2.amazonaws.com/agencia-jaque/profile/perfil.png';
}else {
  foreach ($files as  $file) {
    $imageFileName = mt_rand(1,2147483647) . '.' . $file->getClientOriginalExtension();
    $s3 = \Storage::disk('s3');
    $filePath = '/'.$whapcl.'/' . $imageFileName;
    $s3->put($filePath, file_get_contents($file), 'public');
    $link_req[]='https://s3-us-west-2.amazonaws.com/agencia-jaque'.$filePath;
  }
  $link_=$link_.",".$link_req[0];
  $contador=count($link_req);
  for ($i=1; $i <$contador; $i++) {
    $link_=$link_.','.$link_req[$i];
  }

}

    DB::table('app_clientes')->insert([
    ['alias'=>$nombreartisticocl,'nombre_cliente'=> $nombrecl,'apellido_cliente'=> $apellidocl,'correo_cliente'=> $correocl,'telefono_cliente'=> $telefonocl,'celular'=> $celularcl,'whatsapp'=> $whapcl,
    'facebook'=>$facebook,'twitter'=>$twitter,'instagram'=>$instagram,'pinterest'=>$pinteres,'googleplus'=>$google,'youtube'=>$youtube,
    'nombre_contacto'=> $nombreco,'apellido_contacto'=> $apellidoco,'correo_contacto'=> $correoco,'telefono_contacto'=> $telefonoco,'celular_contacto'=> $celularco,'whatsapp_contacto'=> $whapco,
    'id_plan'=>$planes,'link_foto'=>$link_
    ]
    ]);

$id=DB::table('app_clientes')->max('id_cliente');

    Session::flash('id', $id);
    Session::flash('flash_message', 'Se ha registrado el cliene exitosamente.');
    return Redirect::to('/buscarcliente');
}
public function formularioeditarcliente()
{
  $id=$_GET['id'];
  //return $id;
  $planes=DB::table('app_planes')->get();

  $clientes=DB::table('app_clientes')->where('id_cliente',$id)->take(1)->get();
  return View::make('buscar.editarcliente')->with(array('clientes'=>$clientes,'planes'=>$planes));
}
public function editarcliente(Request $request)
{
  $todo=$request->all();
  $id=$todo['id_cliente'];
  $alias=$todo['alias'];
  //return $todo;
    if (isset($todo['eliminarcl'])) {
    DB::table('app_clientes')->where('id_cliente',$id)->delete();
Session::flash('delete_message', 'Se ha eliminado el cliene exitosamente.');
    }else {
  $planantiguo=$todo['planantiguo'];
  //return $todo;

  if (isset($todo['planes'])) {
  $plan=$todo['planes'];
  $contador=count($plan);
  for ($i=0; $i <$contador ; $i++) {
    $confirm= strpos($planantiguo, $plan[$i]);
    if ($confirm===false) {
      $planantiguo=$planantiguo.",".$plan[$i];
    }else {
    $planantiguo = str_replace($plan[$i],"", $planantiguo);
    }
  }
  $planantiguo = str_replace(",,",",", $planantiguo);

  }

  //return $plan['0'];

  //$nombreartisticocl=$todo['nombreartistico_cl'];
  $nombrecl=$todo['nombre_cl'];
  $apellidocl=$todo['apellido_cl'];
  $telefonocl=$todo['telefono_cl'];
  $correocl=$todo['correo_cl'];
  $celularcl=$todo['celular_cl'];
  $whapcl=$todo['whatsapp_cl'];
  $facebook=$todo['facebook'];
  $twitter=$todo['twitter'];
  $instagram=$todo['instagram'];
  $pinteres=$todo['pinterest'];
  $google=$todo['googleplus'];
  $youtube=$todo['youtube'];

  $nombreco=$todo['nombre_co'];
  $apellidoco=$todo['apellido_co'];
  $correoco=$todo['correo_co'];
  $telefonoco=$todo['telefono_co'];
  $celularco=$todo['celular_co'];
  $whapco=$todo['whatsapp_co'];

  DB::table('app_clientes')->where('id_cliente',$id)->update(['alias'=>$alias,'nombre_cliente'=> $nombrecl,'apellido_cliente'=> $apellidocl,'correo_cliente'=> $correocl,
  'telefono_cliente'=> $telefonocl,'celular'=> $celularcl,'whatsapp'=> $whapcl,'facebook'=>$facebook,'twitter'=>$twitter,
  'instagram'=>$instagram,'pinterest'=>$pinteres,'googleplus'=>$google,'youtube'=>$youtube,'nombre_contacto'=> $nombreco,
  'apellido_contacto'=> $apellidoco,'correo_contacto'=> $correoco,'telefono_contacto'=> $telefonoco,'celular_contacto'=> $celularco,
  'whatsapp_contacto'=> $whapco,'id_plan'=>$planantiguo]);
  Session::flash('flash_message', 'Se ha editado el cliene exitosamente.');
  Session::flash('id', $id);
  }
  return back();

}

public function indexplan()
{
$productos=DB::table('app_productos')->get();

return View::make("registro.plan")->with(array('productos'=>$productos));

}

public function buscarplan()
{
$planes=DB::table('app_planes')->select('id_plan','nombre_plan')->orderBy('nombre_plan','asc')->get();
return View::make("buscar.plan")->with(array('planes'=>$planes));
}

public function verplan()
{
$id=$_GET['id'];
$id;
$planes=DB::table('app_planes')->where('id_plan',$id)->get();
return View::make("buscar.tablaplan")->with(array('planes'=>$planes));
}


public function registrarplan(Request $request)
{
  $todo=$request->all();
  if ($request->has('productos')) {
    $productos=$todo['productos'];
  $producto=implode(",", $productos);
}else {
  $producto=",";
}
$nombre=$todo['nombre'];
$descripcion=$todo['descripcion'];
    DB::table('app_planes')->insert([
    ['nombre_plan'=> $nombre,'descripcion_plan'=> $descripcion,'productos'=> $producto]]);

$id=DB::table('app_planes')->max('id_plan');
    Session::flash('id', $id);
    Session::flash('flash_message', 'Se ha registrado el cliene exitosamente.');
    return Redirect::to('/buscarplan');
}
public function formularioeditarplan()
{
  $id=$_GET['id'];
  $productos=DB::table('app_productos')->get();
  $plan=DB::table('app_planes')->where('id_plan',$id)->take(1)->get();
  return View::make('buscar.editarplan')->with(array('planes'=>$plan,'productos'=>$productos));
}
public function editarplan(Request $request)
{
  $todo=$request->all();
  $id=$todo['planid'];
    if (isset($todo['eliminarplan'])) {
    DB::table('app_planes')->where('id_plan',$id)->delete();
Session::flash('delete_message', 'Se ha eliminado el cliene exitosamente.');
    }else {
  $productosantiguo=$todo['productoantiguo'];
  //return $todo;
  if (isset($todo['productos'])) {
  $productos=$todo['productos'];
  $contador=count($productos);
  for ($i=0; $i <$contador ; $i++) {
    $confirm= strpos($productosantiguo, $productos[$i]);
    if ($confirm===false) {
      if ($productosantiguo=="") {
      $productosantiguo=$productosantiguo.$productos[$i];
    }else {
    $productosantiguo=$productosantiguo.",".$productos[$i];
      }
    }else {
    $productosantiguo = str_replace($productos[$i].",","", $productosantiguo);
    $productosantiguo = str_replace(",".$productos[$i],"", $productosantiguo);
    $productosantiguo = str_replace($productos[$i],"", $productosantiguo);
    }
  }
  $productosantiguo = str_replace(",,",",", $productosantiguo);

  }
  $nombre=$todo['nombre'];
  $descripcion=$todo['descripcion'];



  DB::table('app_planes')->where('id_plan',$id)->update(['nombre_plan'=>$nombre,'descripcion_plan'=>$descripcion,'productos'=>$productosantiguo]);
  Session::flash('flash_message', 'Se ha editado el plan exitosamente.');
  Session::flash('id', $id);
  }
  return back();

}






public function registrarusuario()
{
  $perfiles=DB::table('app_perfil')->get();
  return View::make('auth.register')->with(array('perfiles'=>$perfiles));
}


}
