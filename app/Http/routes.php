<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::auth();
Route::get('/admin', 'HomeController@admin');
Route::get('/realizar-pedido', 'HomeController@realizarpedido');
Route::post('enviar-pedido', 'StorageController@save');
Route::get('/prueba','StorageController@prueba');
Route::get('/show','VistasController@show');
Route::post('/show/update','StorageController@update');
Route::post('/show/process','StorageController@process');
Route::get('/profile','profileController@index');
Route::post('profile','profileController@contrasena');
Route::post('registrarusuario','profileController@pass');
Route::get('/registrar-usuario','ListasController@registrarusuario');


Route::get('/showupdate', 'VistasController@update');
Route::get('/showupdate2', 'VistasController@update2');
Route::get('editarorden', 'VistasController@editarorden');
Route::get('editarordenf', 'VistasController@editarordenf');
Route::post('editarorden', 'VistasController@editarorden');

Route::get('/borrarimagen', 'VistasController@borrarimagen');

Route::get('/homeupdate', 'HomeController@update');
Route::get('/contador', 'HomeController@contador');
Route::get('/adminupdate', 'HomeController@adminupdate');
Route::get('/admincontador', 'HomeController@admincontador');


//registrar
Route::get('/buscarproducto', 'ListasController@buscarproducto');
Route::get('/registrarproducto', 'ListasController@indexproducto');
Route::post('registrar-producto','ListasController@registrarproducto');
Route::get('/verproducto', 'ListasController@verproducto');
Route::get('/editarproducto', 'ListasController@formularioeditarproducto');
Route::post('editarproducto', 'ListasController@editarproducto');


Route::get('/registrarcliente', 'ListasController@indexcliente');
Route::post('registrar-cliente','ListasController@registrarcliente');
Route::get('/buscarcliente', 'ListasController@buscarcliente');
Route::get('/vercliente', 'ListasController@vercliente');
Route::get('/editarcliente', 'ListasController@formularioeditarcliente');
Route::post('editarcliente', 'ListasController@editarcliente');


Route::get('/registrarplan', 'ListasController@indexplan');
Route::post('registrar-plan','ListasController@registrarplan');
Route::get('/buscarplan', 'ListasController@buscarplan');
Route::get('/verplan', 'ListasController@verplan');
Route::get('/editarplan', 'ListasController@formularioeditarplan');
Route::post('editarplan', 'ListasController@editarplan');


Route::get('/tareaenviarcorreo', 'MailController@enviarcorreos');
Route::get('/historial-ordenes', 'VistasController@historial');


Route::get('/historial-ordenes', 'VistasController@historial');
Route::get('/chats', 'ChatController@index');
Route::get('/chatid', 'ChatController@chat');
Route::post('enviarmensaje', 'ChatController@nuevomensaje');
Route::get('/actualizar', 'ChatController@actualizar');
Route::get('/newchatid', 'ChatController@newchat');
Route::get('/actualizarmsjs', 'ChatController@chatmsjs');
Route::get('actualizarcontador', 'ChatController@contador');

Route::post('registrarmovil', 'SendController@registrar');
Route::get('registrarmovil', 'SendController@notificacion');
Route::get('pruebafb', 'VistasController@pruebafb');

Route::get('/facebook/login', function(SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb) {

    $login_link = $fb->getReRequestUrl(['email','publish_actions' , 'manage_pages', 'publish_pages'], 'https://'.$_SERVER['HTTP_HOST']);
    echo '<a href="' . $login_link . '">Log in with Facebook</a>';
});
Route::get('/facebook/callback','VistasController@pruebafb');



//
