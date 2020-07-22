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
}
