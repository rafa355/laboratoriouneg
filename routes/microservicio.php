<?php
/** 
 * RESTful Routes
 **/

Route::post('login','Rest\LoginController@login');
Route::post('register','Rest\RegisterController@register');

Route::get('contrato','laboratorio\MicroServicioController@contrato');
Route::get('consulta/general','laboratorio\MicroServicioController@consultar_general');


Route::get('consulta/estudiantes','laboratorio\MicroServicioController@consultar_estudiantes');
Route::get('consulta/computadoras','laboratorio\MicroServicioController@consultar_computadoras');

Route::post('registro/estudiante','laboratorio\MicroServicioController@registrar_estudiante');
Route::post('registro/computadora','laboratorio\MicroServicioController@registrar_computadora');
Route::post('iniciar_sesion/computadora','laboratorio\MicroServicioController@ocupar_computadora');
Route::post('cerrar_sesion/computadora','laboratorio\MicroServicioController@desocupar_computadora');

