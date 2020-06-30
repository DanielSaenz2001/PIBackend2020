<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Persona;
use App\User;


class UserController extends Controller
{
    public function index(Request $request)
    {
        $result = User::join('personas', 'users.id', '=', 'personas.user_id')
        ->join('roles_users','roles_users.user_id','users.id')
        ->join('roles','roles_users.role_id','roles.id')
        ->select('personas.nombre','personas.ap_materno',
        'personas.ap_paterno', 
        'personas.dni','roles.name as rol')
        ->get();

        return response()->json($result); 
        
    }
    public function filtro(Request $request)
    {
        $nombre =$request->nombre;
        $paterno =$request->ap_paterno;
        $materno =$request->ap_materno;
        $dni =$request->dni;
        $rol =$request->rol;

        if($rol == null || $rol == '' || $rol == 'null'){
            $users = Persona::name($nombre)
            ->join('users', 'personas.user_id', '=', 'users.id')
            ->join('roles_users','roles_users.user_id','users.id')
            ->join('roles','roles_users.role_id','roles.id')
            ->dni($dni)
            ->paterno($paterno)
            ->materno($materno)
            ->select('personas.nombre','personas.ap_materno',
        'personas.ap_paterno', 
        'personas.dni','roles.name as rol')->get();
            return response()->json($users);
        }else{
            $users = Persona::name($nombre)
            ->join('users', 'personas.user_id', '=', 'users.id')
            ->join('roles_users','roles_users.user_id','users.id')
            ->join('roles','roles_users.role_id','roles.id')
            ->where('roles_users.role_id','=',$rol)
        ->dni($dni)
        ->paterno($paterno)
        ->materno($materno)
        ->select('personas.nombre','personas.ap_materno',
        'personas.ap_paterno', 
        'personas.dni','roles.name as rol')->get();
        return response()->json($users);
        }
       
    }

}
