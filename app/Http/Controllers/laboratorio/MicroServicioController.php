<?php

namespace App\Http\Controllers\laboratorio;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Estudiantes;
use App\Computadoras;
use App\ComputadoraEnUso;

class MicroServicioController extends Controller
{
    public function consultar_general(){
        $response = http_get("http://localhost:8000/laboratorio/consulta/estudiantes");

        echo $response;
    }

    public function consultar_estudiantes(){
    	return response()->json(Estudiantes::Consulta());
    }

    public function consultar_computadoras(){
    	return response()->json(Computadoras::Consulta());
    }

    public function registrar_estudiante(Request $request)
    {

        // Creamos las reglas de validación
        $rules = [
            'nombre'      => 'required',
            'cedula'     => 'required|unique:estudiantes,cedula',
                ];

        $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return [
                    'created' => false,
                    'errors'  => $validator->errors()->all()
                ];
            }

       $estudiante = Estudiantes::create($request->all());

       return response()->json($estudiante);
    }

    public function registrar_computadora(Request $request)
    {

        // Creamos las reglas de validación
        $rules = [
            'numero'      => 'required|unique:computadoras,numero',
            'status'     => 'required',
                ];

        $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return [
                    'created' => false,
                    'errors'  => $validator->errors()->all()
                ];
            }
            
       $computadora = Computadoras::create($request->all());

       return response()->json($computadora);
    }


    public function ocupar_computadora(Request $request)
    {

        // Creamos las reglas de validación
        $rules = [
            'computadora'      => 'required|unique:computadoraenuso,computadora',
            'estudiante'     => 'required|unique:computadoraenuso,estudiante',
                ];

        $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return [
                    'created' => false,
                    'errors'  => $validator->errors()->all()
                ];
            }
            $computadora = Computadoras::find($request->computadora);
            $computadora->status= 2;
            $computadora->save();  
            
       $computadoraenuso = ComputadoraEnUso::create($request->all());

       return response()->json($computadoraenuso);
    }


    public function desocupar_computadora(Request $request)
    {

        // Creamos las reglas de validación
        $rules = [
            'computadora'      => 'required',
                ];

        $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return [
                    'created' => false,
                    'errors'  => $validator->errors()->all()
                ];
            }
            $computadora = Computadoras::find($request->computadora);
            $computadora->status= 1;
            $computadora->save();  
            
       $computadoraenuso = ComputadoraEnUso::where('computadora', $request->computadora)->first();;
       $computadoraenuso->delete();

       return response()->json($computadora);
    }
}
