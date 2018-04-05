<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Computadoras extends Model
{

    protected $fillable = [
        'numero', 'status',
    ];

    public static function Consulta(){
        $computadoras = DB::table('computadoras')
            ->select('id','numero','status','created_at')
            ->get();    
        return $computadoras;
      }

}
