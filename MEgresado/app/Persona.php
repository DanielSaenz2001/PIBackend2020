<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    public $timestamps = false;
    protected $guarded = ["id"];

    public function scopeDni($query, $dni){
        if($dni){
            return $query->where('dni','like',"%$dni%");
        }
    }
    public function scopePaterno($query, $paterno){
        if($paterno){
            return $query->where('ap_paterno','like',"%$paterno%");
        }
    }
    public function scopeName($query, $name){
        return $query->where('nombre','like',"%$name%");
    }
    public function scopeMaterno($query, $materno){
        if($materno){
            return $query->where('ap_materno','like',"%$materno%");
        }
    }
    public function scopeCodigo($query, $codigo){
        if($codigo){
            return $query->where('egresados.codigo','like',"%$codigo%")->join('egresados', 'personas.id', '=', 'egresados.persona_id');
        }
    }
    public function scopeEgreso($query, $egreso){
        if($egreso){
            return $query->where('egresados.egreso','like',"$egreso")->join('egresados', 'personas.id', '=', 'egresados.persona_id');
        }
    }
    public function scopeEstado($query, $estado){
        if($estado !== "null"){
            return $query->where('egresados.estado','like',"$estado")->join('egresados', 'personas.id', '=', 'egresados.persona_id');
        }
        if($estado == "null"){
            return $query->where('egresados.estado','like',"%%")->join('egresados', 'personas.id', '=', 'egresados.persona_id');
        }
    }
}
