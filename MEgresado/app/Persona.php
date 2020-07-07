<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    public $timestamps = false;
    protected $guarded = ["id"];

    public function scopeDni($query, $dni){
        if($dni){
            return $query->where('personas.dni','like',"%$dni%");
        }
    }
    public function scopePaterno($query, $paterno){
        if($paterno){
            return $query->where('personas.ap_paterno','like',"%$paterno%");
        }
    }
    public function scopeName($query, $name){
        return $query->where('personas.nombre','like',"%$name%");
    }
    public function scopeMaterno($query, $materno){
        if($materno){
            return $query->where('personas.ap_materno','like',"%$materno%");
        }
    }
    public function scopeCodigo($query, $codigo){
        if($codigo){
            return $query->where('egresados.codigo','like',"%$codigo%");
        }
    }
    public function scopeEgreso($query, $egreso){
        if($egreso){
            return $query->where('egresados.egreso','like',"$egreso");
        }
    }
    public function scopeEstado($query, $estado){

        if($estado){
            return $query->where('egresados.estado','like',"%$estado%");
        }

    }
}
