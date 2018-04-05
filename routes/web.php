<?php
use App\ComputadoraEnUso;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

	$computadoras = ComputadoraEnUso::Consulta_datos();

	return view('welcome')->with(['computadoras'=> $computadoras]);

});


Route::group(['prefix' => 'api'], function(){
	// User routes
	require __DIR__ . '/microservicio.php';
});
Auth::routes();

Route::get('/inicio', 'HomeController@index')->name('home');


Route::get('desconexion', [
	'uses' => 'HomeController@logOut',
	'as' => 'home.logout'
]);


Route::get('/computadoras', [
	'uses' => 'Admin\ComputadorasController@index',
	'as' => 'admin.computadoras.index',
]);

Route::match(['get', 'post', 'put'], '/computadoras/{action}/{id?}/{cedula?}', [
	'uses' => 'Admin\ComputadorasController@handler',
	'as' => 'admin.computadoras.async',
]);

Route::get('/getDataTablesComputadoras', [
	'uses' => 'Admin\ComputadorasController@getDataTables',
	'as' => 'admin.computadoras.datatables',
]);

Route::get('/estudiantes', [
	'uses' => 'Admin\EstudiantesController@index',
	'as' => 'admin.estudiantes.index',
]);

Route::match(['get', 'post', 'put'], '/estudiantes/{action}/{id?}/{cedula?}', [
	'uses' => 'Admin\EstudiantesController@handler',
	'as' => 'admin.estudiantes.async',
]);

Route::get('/getDataTablesCOmputadoras', [
	'uses' => 'Admin\EstudiantesController@getDataTables',
	'as' => 'admin.estudiantes.datatables',
]);