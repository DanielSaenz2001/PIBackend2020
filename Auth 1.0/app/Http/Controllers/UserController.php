<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Persona;
use App\User;
use App\RolesUser;
use App\Roles;

use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;


class UserController extends Controller
{
    public function index(Request $request)
    {
        $result = User::join('personas', 'users.id', '=', 'personas.user_id')
        ->join('roles_users','roles_users.user_id','users.id')
        ->join('roles','roles_users.role_id','roles.id')
        ->select('personas.nombre','personas.ap_materno',
        'personas.ap_paterno', 
        'personas.dni','roles.name as rol','users.id')
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
        'personas.dni','roles.name as rol','users.id')->get();
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
        'personas.dni','roles.name as rol','users.id')->get();
        return response()->json($users);
        }
       
    }
    public function show($id)
    {
        $usuario = User::join('personas', 'users.id', '=', 'personas.user_id')
        ->join('roles_users','roles_users.user_id','users.id')
        ->join('roles','roles_users.role_id','roles.id')
        ->where('users.id', '=',$id)
        ->select('personas.nombre','personas.ap_materno',
        'personas.ap_paterno', 
        'personas.dni','roles.name as rol','users.id','personas.sexo','roles_users.id as roles_users')
        ->first();

        $Roles = Roles::all();


        return response()->json(['usuario' => $usuario, 
        'roles' => $Roles]);
    }
    public function rolesshow($id)
    {
        $RolesUser= RolesUser::findOrFail($id);
        return response()->json($RolesUser);
    }
    public function autorizadousuarioshow($id)
    {
        $User= User::findOrFail($id)
        ->select('users.id','users.autorizado')
        ->first();
        return response()->json($User);
    }

    
    public function actualizarRolUsuario(Request $request, $id)
    {
        $RolesUser = RolesUser::findOrFail($id);
        $RolesUser->role_id = $request->role_id;
        $RolesUser->save();
        return response()->json($RolesUser);
    }
    public function actualizarAutorizacionUsuario(Request $request, $id)
    {
        $User = User::findOrFail($id);
        $User->autorizado = $request->autorizado;
        $User->save();
        return response()->json($User);
    }

    public function exportPdf()
    {
        $personas  = Persona::get();
        $pdf    = PDF::loadView('pdf.users', compact('personas'));
        
        return $pdf->download('user-list.pdf');
    }
    public function exportExcel()
    {
        return Excel::download(new UsersExport, 'dera-list.xlsx');
    }
}
