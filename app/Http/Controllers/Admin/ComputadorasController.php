<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Computadoras;
use App\Estudiantes;
use Yajra\Datatables\Datatables;
use DB;
use App\ComputadoraEnUso;

class ComputadorasController extends Controller
{
    public function index()
    {
            return view('admin.computadoras.index');

    }

    public function main()
    {
        return view('admin.computadoras.async')->with('type', __FUNCTION__);
    }
    public function create()
    {
        return view('admin.computadoras.async')->with('type', __FUNCTION__);
    }
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.computadoras.async')->with('type', __FUNCTION__)->with('user', $user);
    }

    public function store()
    {
        $request = request();
        // Creamos las reglas de validación
        $rules = [
            'numero'      => 'required|unique:computadoras,numero',
            'status'     => 'required',
                ];

        $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json(['error'=>$validator->errors()->all()]);
            }
            
       $computadora = Computadoras::create($request->all());

       return response()->json($computadora);
    }

    public function update($id)
    {
        $request = request();
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:computadoras,email,'.$id,
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
        $user = User::find($id);
        $user->is_active= '9';
        $user->type= 'S';
        $user->email= 'usuario'.$user->id.' '.$user->name.' eliminado ';
        $user->save();


    }


    

    public function ocupar()
    {
        $request = request();

        $computadora = Computadoras::where('numero', $request->computadora)->first();
        $estudiante = Estudiantes::where('cedula', $request->cedula)->first();




        $computadoraenuso = new ComputadoraEnUso();

        $computadoraenuso->estudiante = $estudiante->id;
        $computadoraenuso->computadora = $computadora->id;
        $computadoraenuso->save();

        $computadora->status= 2;
        $computadora->save();  
    
    }

    public function desocupar($id)
    {
 
        $computadora = Computadoras::find($id);
        $computadora->status= 1;
        $computadora->save();  
        
   $computadoraenuso = ComputadoraEnUso::where('computadora',$computadora->id)->first();;
   $computadoraenuso->delete();
    }


    public function handler($action='', $id='')
    {
        if(method_exists($this, $action)){
            return call_user_func(array($this, $action), $id);
        }else{
            return redirect()->route('admin.computadoras.index');
        }
    }

    public function getDataTables() {
        $computadoras = Computadoras::Consulta();

        return Datatables::of($computadoras)
                ->editColumn('created_at', function($computadoras) {
                    return $computadoras->created_at;
                })
                ->addColumn('status', function($computadoras) {
                    $color = $computadoras->status == 1 ? 'green' : 'red';
                    return '<i class="fa fa-circle" style="color: '.$color.'" aria-hidden="true"></i>';
                })
                ->addColumn('actions', function($computadoras) {
                    return '<a href="'.route('admin.computadoras.async', ['desocupar', 'id'=> $computadoras->id]).'" class="btn btn-xs btn-primary desocupar" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i> Desocupar</a>&nbsp;<a href="'.route('admin.computadoras.async', ['delete', 'id'=> $computadoras->id]).'" class="btn btn-xs btn-danger function delete" data-toggle="tooltip" data-placement="top" title="Activar"><i class="fa fa-trash"></i> Eliminar</a>';
                })
                ->rawColumns(['status', 'actions'])
                ->make(true);
    }



}
