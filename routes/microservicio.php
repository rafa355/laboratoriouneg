<?php
/** 
 * RESTful Routes
 **/

Route::post('login','Rest\LoginController@login');
Route::post('register','Rest\RegisterController@register');


Route::get('consulta/general','laboratorio\MicroServicioController@consultar_general');


Route::get('consulta/estudiantes','laboratorio\MicroServicioController@consultar_estudiantes');
Route::get('consulta/computadoras','laboratorio\MicroServicioController@consultar_computadoras');

Route::post('registro/estudiante','laboratorio\MicroServicioController@registrar_estudiante');
Route::post('registro/computadora','laboratorio\MicroServicioController@registrar_computadora');
Route::post('ocupar/computadora','laboratorio\MicroServicioController@ocupar_computadora');
Route::post('desocupar/computadora','laboratorio\MicroServicioController@desocupar_computadora');

