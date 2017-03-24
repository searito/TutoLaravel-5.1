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


Route::get('/', 'HomeController@home');
Route::get('/home', 'HomeController@home');

Route::get('home/searchredirect', function(){
	$search = urlencode(e(Input::get('search')));
	$route = "home/search/$search";
	return redirect($route);
});

Route::get('home/user/{id}', 'HomeController@user')->where(['id' => '[0-9]+']);

Route::get('home/search/{search}', 'HomeController@search');

Route::get('home/id/{id}', 'HomeController@getId');
Route::get('home/id1/{id1}/id2/{id2}', 'HomeController@GetIds');

Route::get('home/showview', 'HomeController@ShowView');

//---- PETICIONES DEL TIPO GET Y POST --------//
//Route::match(["get", "post"], "home/form", "HomeController@Form");
Route::any("home/form", "HomeController@Form"); // ESTA Y LA DE ARRIBA SIRVEN PARA LO MISMO

Route::get('home/nombre/{nombre}/apellidos/{apellidos}', function($nombre, $apellidos){
	return "El Valor Del Argumento Nombre Es: ".$nombre.", Mientras Que el Valor Del Argumento Apellidos Es: ".$apellidos;
})->where(["nombre" => "[a-zA-Záéíóú]+", "apellidos" => "[a-zA-Záéíóú]+"]);


Route::get("home/miformulario", "HomeController@miFormulario");  ## ("RUTA", "CONTROLADOR@FUNCION QUE QUIERO USAR")
Route::post("home/validarmiformulario", "HomeController@validarMiFormulario");

Route::get("auth/register", "Auth\AuthController@getRegister");
Route::post("auth/register", "Auth\AuthController@postRegister");

Route::get("auth/confirm/email/{email}/confirm_token/{confirm_token}", "Auth\AuthController@confirmRegister");

Route::get("auth/login", "Auth\AuthController@getLogin");
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get("auth/logout", "Auth\AuthController@getLogout");

Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

Route::get('user', 'UserController@user');

Route::get('user/profile', 'UserController@profile');
Route::post('user/updateprofile', 'UserController@updateProfile');

Route::get('user/password', 'UserController@password');
Route::post('user/updatepassword', 'UserController@updatePassword');

Route::post('user/createcomment', 'UserController@createComment');

Route::post('user/deletecomment', 'UserController@deleteComment');

Route::post('user/editcomment', 'UserController@editComment');
Route::get('user/download', 'UserController@download');

#Route::match(['get', 'post'], 'admin/createadmin', 'AdminController@createAdmin');
Route::get('admin/admin', 'AdminController@admin');

// ------  LOGIN SOCIAL   -----//
Route::get('social/{provider?}', 'SocialController@getSocialAuth');
Route::get('social/callback/{provider?}', 'SocialController@getSocialAuthCallback');