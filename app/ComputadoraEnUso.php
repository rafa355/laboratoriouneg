<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class ComputadoraEnUso extends Model
{
    protected $table = 'computadoraenuso';

    protected $fillable = [
        'computadora', 'estudiante',
    ];

    public static function Consulta_datos(){
        $computadoras = DB::table('computadoras')
            ->leftJoin('computadoraenuso', 'computadoras.numero', '=', 'computadoraenuso.computadora')
            ->leftJoin('estudiantes', 'computadoraenuso.estudiante', '=', 'estudiantes.id')
            ->select('computadoraenuso.id AS iduso','computadoras.id AS idlibre','computadoras.numero AS numero','computadoras.status AS status','estudiantes.nombre AS estudiante')
            ->get();    
        return $computadoras;
      }
}
