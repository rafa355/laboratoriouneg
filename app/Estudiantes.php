<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Estudiantes extends Model
{
    protected $fillable = [
        'nombre', 'cedula',
    ];

    public static function Consulta(){
        $estudiantes = DB::table('estudiantes')
            ->select('id','nombre','cedula','created_at')
            ->get();    
        return $estudiantes;
      }
    
    }
