<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use Carbon\Carbon;
use App\Http\Requests;
use Auth;
use Session;
use View;
use DB;
use Redirect;
use File;

class VistasController extends Controller
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
    public function show()
    {
      $fechahoy = Carbon::now();
      $fechahoy=$fechahoy->format('l jS \\of F Y h:i:s A');
      $clientes =DB::table('app_clientes')->get();
      $productos=DB::table('app_productos')->get();
      $usuario=DB::table('users')->get();
      $requerimientos=$_GET['id'];
      $requerimiento = DB::table('app_requerimientos')->where('id_requerimiento', $requerimientos)->take(1)->get();

    return View::make("show")->with(array('requerimiento'=>$requerimiento,'clientes'=>$clientes,'usuario'=>$usuario,'productos'=>$productos,'fechahoy'=>$fechahoy));
    }
    public function update()
    {
    $requerimientos=$_GET['id'];
    $requerimiento = DB::table('app_requerimientos')->where('id_requerimiento', $requerimientos)->take(1)->get();
    Redirect::to('home');
    return View::make("layouts.partials.tablashow")->with(array('requerimiento'=>$requerimiento));
    }
    public function update2()
    {
    $requerimientos=$_GET['id'];
    $requerimiento = DB::table('app_requerimientos')->where('id_requerimiento', $requerimientos)->take(1)->get();

    return View::make("layouts.partials.tablas.showreq")->with(array('requerimiento'=>$requerimiento));
    }
    public function borrarimagen(){
      $link=$_GET['link'];
      $id_req=$_GET['id'];
      $s3 = \Storage::disk('s3');
      $s3->delete($link);
      $requerimiento = DB::table('app_requerimientos')->where('id_requerimiento',$id_req)->take(1)->get();
      foreach ($requerimiento as $value) {
        $cadena=$value->link_adjunto_requerimiento;
        $cadena2=$value->trabajo_realizado;
      }
      $link_ = str_replace($link,"", $cadena);
      $link_2 = str_replace($link,"", $cadena2);
      DB::table('app_requerimientos')->where('id_requerimiento',$id_req)->
      update(['link_adjunto_requerimiento'=>$link_,'trabajo_realizado'=>$link_2]);
      return Redirect::action('VistasController@show', $enviar=array('id' => $id_req));
    }
    public function editarorden()
    {
    $requerimiento = DB::table('app_requerimientos')->where('id_usuario', Auth::user()->id)->whereIn('estado_requerimiento',[1,7])->get();
    return View::make("layouts.partials.editarorden")->with(array('requerimiento'=>$requerimiento));
    }
    public function editarordenf()
    {
      $fechahoy = Carbon::now();
      $fechahoy=$fechahoy->format('l jS \\of F Y h:i:s A');
      $clientes =DB::table('app_clientes')->get();
      $productos=DB::table('app_productos')->get();
      $usuario=DB::table('users')->get();
      $requerimientos=$_GET['id'];
      $requerimiento = DB::table('app_requerimientos')->where('id_requerimiento', $requerimientos)->take(1)->get();
    if(Auth::guest()){
    Redirect::to('home');
    }else{
    return View::make("layouts.editarorden")->with(array('requerimiento'=>$requerimiento,'clientes'=>$clientes,'usuario'=>$usuario,'productos'=>$productos,'fechahoy'=>$fechahoy));
    }
    }
    public function historial()
    {
      $requerimientos = DB::table('app_requerimientos')->where('id_usuario',Auth::user()->id)->orwhere('id_operador',Auth::user()->id)->orwhere('aprobadopor',Auth::user()->id)->get();
      return View::make("buscar.ordenes")->with(array('requerimientos'=>$requerimientos));
    }
    public function pruebafb()
    {
      $fb = app('SammyK\LaravelFacebookSdk\LaravelFacebookSdk');
      {
          // Obtain an access token.
          try {
              $token = $fb->getAccessTokenFromRedirect();
          } catch (Facebook\Exceptions\FacebookSDKException $e) {
              dd($e->getMessage());
          }

          // Access token will be null if the user denied the request
          // or if someone just hit this URL outside of the OAuth flow.
          if (! $token) {
              // Get the redirect helper
              $helper = $fb->getRedirectLoginHelper();

              if (! $helper->getError()) {
                  abort(403, 'Unauthorized action.');
              }

              // User denied the request
              dd(
                  $helper->getError(),
                  $helper->getErrorCode(),
                  $helper->getErrorReason(),
                  $helper->getErrorDescription()
              );
          }

          if (! $token->isLongLived()) {
              // OAuth 2.0 client handler
              $oauth_client = $fb->getOAuth2Client();

              // Extend the access token.
              try {
                  $token = $oauth_client->getLongLivedAccessToken($token);
              } catch (Facebook\Exceptions\FacebookSDKException $e) {
                  dd($e->getMessage());
              }
          }

          $fb->setDefaultAccessToken($token);

          // Save for later
          //Session::put('fb_user_access_token', (string) $token);
          DB::table('users')->where('id',Auth::user()->id)->update(['token' => $token]);


          // Get basic info on the user from Facebook.
          try {
              $response = $fb->get('/me?fields=id,name,email');
          } catch (Facebook\Exceptions\FacebookSDKException $e) {
              dd($e->getMessage());
          }

          // Convert the response to a `Facebook/GraphNodes/GraphUser` collection


          $data = [
            'message' => 'My neat photo',
            'source' => $fb->fileToUpload('img/10.jpg'),
          ];

          try {
            $response = $fb->post('/me/photos', $data, $token);
          } catch(Facebook\Exceptions\FacebookSDKException $e) {
            echo $e->getMessage();
            exit;
          }

          $objectId = $response->getGraphObject();
          var_dump($objectId);

          echo 'Photo ID: ' . $objectId['id'];
          // Create the user if it does not exist or update the existing entry.
          // This will only work if you've added the SyncableGraphNodeTrait to your User model.
          //$user = App\User::createOrUpdateGraphNode($facebook_user);

          // Log the user into Laravel
          //Auth::login($user);

          echo 'foto subida';
      }
    }
}
