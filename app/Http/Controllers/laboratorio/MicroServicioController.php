<?php

namespace App\Http\Controllers\laboratorio;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Estudiantes;
use App\Computadoras;
use App\ComputadoraEnUso;
use GuzzleHttp\Client;

class MicroServicioController extends Controller
{

    public function contrato(){
        
        $consulta = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://192.168.101.92:5000',
            // You can set any number of default request options.
            'timeout'  => 10.0,
        ]);
    
        $response= $consulta->request('GET','api/consulta/computadoras');
    
        $estudiante = json_decode($response->getBody()->getContents());
        

    	return response()->json(Estudiantes::Consulta());
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

            $consulta = new Client([
                // Base URI is used with relative requests
                'base_uri' => 'http://127.0.0.1:8000',
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

            $returnData = array(
                'status' => 'EXITO',
                'message' => 'Estudiante registrado en laboratorio!'
            );

            return response()->json([$returnData]);
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

       $returnData = array(
        'status' => 'EXITO',
        'message' => 'Computadora Ocupada con exito!'
    );

    return response()->json([$returnData]);
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

       $returnData = array(
        'status' => 'EXITO',
        'message' => 'Computadora Desocupada con exito!'
    );   
    return response()->json([$returnData]);


}
}
