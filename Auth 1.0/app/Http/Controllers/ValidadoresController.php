<?php

namespace App\Http\Controllers;

use App\Persona;
use App\User;
use Illuminate\Http\Request;

class ValidadoresController extends Controller
{
    public function Persona()
    {
        $result = User::join('personas', 'users.id', '=', 'personas.user_id')
        ->join('distritos', 'personas.distrito', '=', 'distritos.id')
        ->join('provincias', 'distritos.pro_id', '=', 'provincias.id')
        ->join('departamentos', 'provincias.dep_id', '=', 'departamentos.id')
        ->join('paises', 'departamentos.pais_id', '=', 'paises.id')
        
        ->where('users.id','=',auth()->user()->id)
        ->select('personas.nombre','personas.ap_materno',
        'personas.ap_paterno', 'paises.nombre as pais',
        'personas.email','personas.fec_nacimiento','personas.est_civil','personas.sexo' 
        ,'departamentos.nombre as departamentos','personas.id as persona_ID','users.id as user_ID','provincias.nombre as provincia', 'personas.dni',
        'personas.validado')
        ->first();
        return response()->json($result);
    }
    public function Rol()
    {
        $result = User::join('roles_users', 'users.id', '=', 'roles_users.user_id')
        ->join('roles', 'roles.id', '=', 'roles_users.role_id')
        ->where('users.id','=',auth()->user()->id)
        ->select('users.id as USERID','roles_users.role_id as ROLEID','roles.name as ROLENAME')
        ->get();
        return response()->json($result);
    }
}
