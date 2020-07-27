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
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'filtro','show'
        ,'rolesshow','rolesshow','autorizadousuarioshow','exportExcel','exportPdf','exportPdf2']]);
    }
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
        $user = User::join('roles_users', 'users.id', '=', 'roles_users.user_id')
        ->where('users.id','=',auth()->user()->id)
        ->select('roles_users.role_id as ROLEID','users.autorizado','users.validado')
        ->first();
        if($user->ROLEID == 1){
            $RolesUser = RolesUser::findOrFail($id);
            $RolesUser->role_id = $request->role_id;
            $RolesUser->save();
        }
        
    }
    public function actualizarAutorizacionUsuario(Request $request, $id)
    {
        $user = User::join('roles_users', 'users.id', '=', 'roles_users.user_id')
        ->where('users.id','=',auth()->user()->id)
        ->select('roles_users.role_id as ROLEID','users.autorizado','users.validado')
        ->first();
        if($user->ROLEID == 1){
            $User = User::findOrFail($id);
            $User->autorizado = $request->autorizado;
            $User->save();
        }
    }

    public function exportPdf($id)
    {

            $personas  = Persona::join('users','users.id','personas.user_id')->
            join('egresados','personas.id','egresados.persona_id')->
            join('egresados_escuelas','egresados.id','egresados_escuelas.egresado_id')->
            join('escuelas','egresados_escuelas.escuela_id','escuelas.id')->
            join('facultades','escuelas.facultad_id','facultades.id')->
            join('distritos', 'egresados.distrito_id', 'distritos.id')->
            join('provincias', 'distritos.pro_id', 'provincias.id')->
            join('departamentos', 'provincias.dep_id', 'departamentos.id')->
            join('paises', 'departamentos.pais_id', 'paises.id')->
            where('users.id','=',$id)->
            select('personas.nombre','personas.ap_paterno','personas.ap_materno','personas.dni',
            'personas.fec_nacimiento','personas.sexo', 'personas.email','egresados.celular',
            'egresados.codigo','egresados.egreso','escuelas.nombre as escuelas','facultades.nombre as facultades',
            'paises.nombre as pais_domicilio','departamentos.nombre as departamento_domicilio',
            'provincias.nombre as provincia_domicilio','distritos.nombre as distrito_domicilio',
            'egresados.direccion','egresados.referencia')->get();

            $xp  = Persona::join('users','users.id','personas.user_id')->
            join('egresados','personas.id','egresados.persona_id')->
            join('experiencia_laborales','egresados.id','experiencia_laborales.egresado_id')->
            where('users.id','=',$id)->
            select('experiencia_laborales.empresa','experiencia_laborales.rubro_empresa',
            'experiencia_laborales.inicio','experiencia_laborales.final')->get();

            $pg  = Persona::join('users','users.id','personas.user_id')->
            join('egresados','personas.id','egresados.persona_id')->
            join('postgrados_otros','egresados.id','postgrados_otros.egresado_id')->
            where('users.id','=',$id)->
            select('postgrados_otros.agrado_academico','postgrados_otros.entidad',
            'postgrados_otros.desde','postgrados_otros.hasta')->get();
            $pdf = PDF::loadView('pdf.users', compact('personas','xp','pg'));

            $nombre= Persona::join('users','users.id','personas.user_id')->
            join('egresados','personas.id','egresados.persona_id')->
            where('users.id','=',$id)->
            select('personas.nombre','personas.ap_paterno','personas.ap_materno','personas.dni',
            'personas.fec_nacimiento','personas.sexo', 'personas.email','egresados.celular',
            'egresados.codigo')->first();

            return $pdf->download('CURRICULUM_VITAE_'.$nombre->codigo.'.pdf');
    }
    public function exportPdf2($id)
    {

            $personas  = Persona::join('users','users.id','personas.user_id')->
            join('egresados','personas.id','egresados.persona_id')->
            join('egresados_escuelas','egresados.id','egresados_escuelas.egresado_id')->
            join('escuelas','egresados_escuelas.escuela_id','escuelas.id')->
            join('facultades','escuelas.facultad_id','facultades.id')->
            join('distritos', 'egresados.distrito_id', 'distritos.id')->
            join('provincias', 'distritos.pro_id', 'provincias.id')->
            join('departamentos', 'provincias.dep_id', 'departamentos.id')->
            join('paises', 'departamentos.pais_id', 'paises.id')->
            where('egresados.id','=',$id)->
            select('personas.nombre','personas.ap_paterno','personas.ap_materno','personas.dni',
            'personas.fec_nacimiento','personas.sexo', 'personas.email','egresados.celular',
            'egresados.codigo','egresados.egreso','escuelas.nombre as escuelas','facultades.nombre as facultades',
            'paises.nombre as pais_domicilio','departamentos.nombre as departamento_domicilio',
            'provincias.nombre as provincia_domicilio','distritos.nombre as distrito_domicilio',
            'egresados.direccion','egresados.referencia')->get();

            $xp  = Persona::join('users','users.id','personas.user_id')->
            join('egresados','personas.id','egresados.persona_id')->
            join('experiencia_laborales','egresados.id','experiencia_laborales.egresado_id')->
            where('egresados.id','=',$id)->
            select('experiencia_laborales.empresa','experiencia_laborales.rubro_empresa',
            'experiencia_laborales.inicio','experiencia_laborales.final')->get();

            $pg  = Persona::join('users','users.id','personas.user_id')->
            join('egresados','personas.id','egresados.persona_id')->
            join('postgrados_otros','egresados.id','postgrados_otros.egresado_id')->
            where('egresados.id','=',$id)->
            select('postgrados_otros.agrado_academico','postgrados_otros.entidad',
            'postgrados_otros.desde','postgrados_otros.hasta')->get();
            $pdf = PDF::loadView('pdf.users', compact('personas','xp','pg'));

            $nombre= Persona::join('users','users.id','personas.user_id')->
            join('egresados','personas.id','egresados.persona_id')->
            where('egresados.id','=',$id)->
            select('personas.nombre','personas.ap_paterno','personas.ap_materno','personas.dni',
            'personas.fec_nacimiento','personas.sexo', 'personas.email','egresados.celular',
            'egresados.codigo')->first();

            return $pdf->download('CURRICULUM_VITAE_'.$nombre->codigo.'.pdf');
    }
    public function exportExcel()
    {
        $pg =Excel::download(new UsersExport, 'dera-list.xlsx');
        return $pg;
    }
}
