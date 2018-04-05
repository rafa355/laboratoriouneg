<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Estudiantes;
use Yajra\Datatables\Datatables;
use DB;
use GuzzleHttp\Client;

class EstudiantesController extends Controller
{
    public function index()
    {
            return view('admin.estudiantes.index');

    }

    public function main()
    {
        return view('admin.estudiantes.async')->with('type', __FUNCTION__);
    }
    public function create()
    {
        return view('admin.estudiantes.async')->with('type', __FUNCTION__);
    }
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.estudiantes.async')->with('type', __FUNCTION__)->with('user', $user);
    }

    public function store()
    {
        $request = request();
        // Creamos las reglas de validación
        $rules = [
            'nombre'      => 'required',
            'cedula'     => 'required|unique:estudiantes,cedula',
                ];

                $validator = \Validator::make($request->all(), $rules);
                if ($validator->fails()) {
                    return response()->json(['error'=>$validator->errors()->all()]);
                }

                $consulta = new Client([
                    // Base URI is used with relative requests
                    'base_uri' => 'http://localhost:8000',
                    // You can set any number of default request options.
                    'timeout'  => 10.0,
                ]);
            
                $response= $consulta->request('GET','/estudiantes/consulta');
            
                $estudiante = json_decode($response->getBody()->getContents());
                
                foreach($estudiante as $estudiante){
                    if($estudiante->cedula == $request->cedula){
                    $usuario = Estudiantes::create($request->all());
                    }
                }

                if(empty($usuario)){
                $returnData = array(
                    'status' => 'ERROR',
                    'message' => 'Esta persona no se encuentra en el registro de la universidad!'
                );
                return response()->json(['error'=>$returnData]);
                }

       return response()->json("guardado en sistema");


    }

    public function update($id)
    {
        $request = request();
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:estudiantes,email,'.$id,
        ]);

        if ($validator->passes()) {
            $user = User::find($id);

            $nombre = $user->name;
            $status_actual = $user->is_active;


            $user->fill($request->all());
            $user->save();

            $response = ['message' => 'Usuario actualizado con exito.'];
            return response()->json($response);
        }

        return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function delete($id)
    {
        $user = Estudiantes::find($id);
        $user->is_active= '9';
        $user->type= 'S';
        $user->email= 'usuario'.$user->id.' '.$user->name.' eliminado ';
        $user->save();


    }

    public function handler($action='', $id='')
    {
        if(method_exists($this, $action)){
            return call_user_func(array($this, $action), $id);
        }else{
            return redirect()->route('admin.estudiantes.index');
        }
    }

    public function getDataTables() {
        $estudiantes = Estudiantes::Consulta();

        return Datatables::of($estudiantes)
                ->editColumn('created_at', function($estudiantes) {
                    return $estudiantes->created_at;
                })
                ->addColumn('actions', function($estudiantes) {
                    return '<a href="'.route('admin.estudiantes.async', ['delete', 'id'=> $estudiantes->id]).'" class="btn btn-xs btn-danger function delete" data-toggle="tooltip" data-placement="top" title="Activar"><i class="fa fa-trash"></i> Eliminar</a>';
                })
                ->rawColumns(['status', 'actions'])
                ->make(true);
    }

}
