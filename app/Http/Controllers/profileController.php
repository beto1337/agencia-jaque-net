<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use App\Http\Requests;
use View;
use Auth;
use Hash;
use Session;
use Redirect;
use DB;
use Illuminate\Support\Facades\Password;
class profileController extends Controller
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
      return View('profile');
    }
    public function cambiarcontrasena(Request $request)
    {
      $todo=$request->all();

    }

    public function contrasena(Request $request){
      $todo=$request->all();
      //return $todo;
      $telefono=$request['telefono'];
      $direccion=$request['direccion'];
      $cumpleanos=$request['cumpleanos'];
      $cumpleanos=str_replace("/", "-", $cumpleanos);

      if (empty($telefono)) {
        $telefono=Auth::user()->telefono_usuario;
      }
      if (empty($direccion)) {
          $direccion=Auth::user()->direccion;
      }
      if (empty($cumpleanos)) {
        $cumpleanos=Auth::user()->cumple;
      }
      $files= $request->file('foto');
      //return $files;

      if (empty($files)) {
        $link_=Auth::user()->link_perfil;
      }else {
          $imageFileName = Auth::user()->id. '.' . $files->getClientOriginalExtension();
          $s3 = \Storage::disk('s3');
          $filePath ='/profile'.Auth::user()->id.'/' . $imageFileName;
          $f='https://s3-us-west-2.amazonaws.com/agencia-jaque/profile'.Auth::user()->id;
          if(file_exists($f)){

            $s3->delete($f);
          }

          $s3->put($filePath, file_get_contents($files), 'public');
          $link_='https://s3-us-west-2.amazonaws.com/agencia-jaque'.$filePath;
      }
      if ($request->has('cambiarcon')) {
      $pass=$todo['pass'];
      $pass2=$todo['pass2'];

      if ($pass==$pass2) {
        DB::table('users')
              ->where('id', Auth::user()->id)
              ->update(['telefono_usuario' => $telefono,'direccion'=>$direccion,'cumple'=>$cumpleanos,'link_perfil'=>$link_,'password'=> bcrypt($pass)]);
        Auth::logout();
        Session::flash('flash_message', 'Contraseña cambiada exitosamente');
        return Redirect::to('/login');
      }else {
        Session::flash('flash_message', 'Las contraseñas deben coincidir.');
        return Redirect::to('/profile');
      }
    }else {
      DB::table('users')
            ->where('id', Auth::user()->id)
            ->update(['telefono_usuario' => $telefono,'direccion'=>$direccion,'cumple'=>$cumpleanos,'link_perfil'=>$link_]);
      return redirect()->action('ProfileController@index');
        }
    }
    public function pass(Request $request)
    {
      $todo=$request->all();
      $this->validate($request, [
        'name' => 'required|max:255',
        'email' => 'required|email|max:255|unique:users',
        'password' => 'required|confirmed|min:6',
        'id_perfil' => 'required',]);

        DB::table('users')->insert([
        ['name'=>$request['name'],'password'=> bcrypt($request['password']),'id_perfil'=>$request['id_perfil'],
         'email'=> $request['email'] ]
       ]);
        Session::flash('flash_message', 'Usuario creado existoasmente.');
        return Redirect::to('/registrar-usuario');


        }


}
