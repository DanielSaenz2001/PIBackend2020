<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ExperienciaLaborales;
use App\ExpValidacionUsers;
use App\Persona;
class ExperienciaLaboralesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index','show']]);
    }
    public function index(Request $request)
    {
        $experiencia = ExperienciaLaborales::all();
        return response()->json($experiencia);
        
    }
    public function create(Request $request)
    {
        $user = Persona::join('users','personas.user_id','users.id')
        ->join('egresados','personas.id','egresados.persona_id')
        ->join('roles_users','roles_users.user_id','users.id')
        ->where('users.id','=',auth()->user()->id)
        ->select('egresados.id as egresado','personas.validado as vali'
        ,'users.autorizado','users.validado','roles_users.role_id as role')
        ->first();
        if(($user->vali== 1 && $user->role == 3)){
            $experiencia = new ExperienciaLaborales();
            $experiencia->empresa = $request->empresa;
            $experiencia->rubro_empresa = $request->rubro_empresa;
            $experiencia->cargo_ocupar = $request->cargo_ocupar;
            $experiencia->area = $request->area;
            $experiencia->inicio  = $request->inicio;
            $experiencia->final  = $request->final;
            $experiencia->satisfacion   = $request->satisfacion;
            $experiencia->descripcion   = $request->descripcion;
            $experiencia->validado   =false;
            $experiencia->evidencia   = $request->evidencia;
            $experiencia->egresado_id   = $user->egresado_id;
            $experiencia->save();
            return response()->json($experiencia);
        }
        if(($user->role == 1)){
            $experiencia = new ExperienciaLaborales();
            $experiencia->empresa = $request->empresa;
            $experiencia->rubro_empresa = $request->rubro_empresa;
            $experiencia->cargo_ocupar = $request->cargo_ocupar;
            $experiencia->area = $request->area;
            $experiencia->inicio  = $request->inicio;
            $experiencia->final  = $request->final;
            $experiencia->satisfacion   = $request->satisfacion;
            $experiencia->descripcion   = $request->descripcion;
            $experiencia->validado   =false;
            $experiencia->evidencia   = $request->evidencia;
            $experiencia->egresado_id   = $request->egresado_id;
            $experiencia->save();
            return response()->json($experiencia);
        }
    }
    public function show($id)
    {
        $experiencia= ExperienciaLaborales::findOrFail($id);
        return response()->json($experiencia);
    }
    public function update(Request $request, $id)
    {
        $user = Persona::join('users','personas.user_id','users.id')
        ->join('egresados','personas.id','egresados.persona_id')
        ->join('roles_users','roles_users.user_id','users.id')
        ->where('users.id','=',auth()->user()->id)
        ->select('egresados.id as egresado','personas.validado as vali'
        ,'users.autorizado','users.validado','roles_users.role_id as role')
        ->first();
        $experiencia = ExperienciaLaborales::findOrFail($id);
        if(($user->vali== 1 && $user->role == 3) &&($experiencia->egresado_id == $user->egresado)){
            $experiencia->empresa = $request->empresa;
            $experiencia->rubro_empresa = $request->rubro_empresa;
            $experiencia->cargo_ocupar = $request->cargo_ocupar;
            $experiencia->area = $request->area;
            $experiencia->inicio  = $request->inicio;
            $experiencia->final  = $request->final;
            $experiencia->satisfacion   = $request->satisfacion;
            $experiencia->descripcion   = $request->descripcion;
            $experiencia->evidencia   = $request->evidencia;
            $experiencia->egresado_id   = $request->egresado_id;
            $experiencia->save();
            return response()->json($experiencia);
        }
        
    }
    public function destroy($id)
    {
        $user = Persona::join('users','personas.user_id','users.id')
        ->join('egresados','personas.id','egresados.persona_id')
        ->join('roles_users','roles_users.user_id','users.id')
        ->where('users.id','=',auth()->user()->id)
        ->select('egresados.id as egresado','personas.validado as vali'
        ,'users.autorizado','users.validado','roles_users.role_id as role')
        ->first();
        $exp=ExperienciaLaborales::findOrFail($id);
        if(($user->vali== 1 && $user->role == 3) &&($exp->egresado_id== $user->egresado)){
            ExperienciaLaborales::findOrFail($id)->delete();
        }
       
    }
    public function vervalidacion($id)
    {
        $user = Persona::join('users','personas.user_id','users.id')
        ->join('egresados','personas.id','egresados.persona_id')
        ->join('roles_users','roles_users.user_id','users.id')
        ->where('users.id','=',auth()->user()->id)
        ->select('egresados.id as egresado','personas.validado as vali'
        ,'users.autorizado','users.validado','roles_users.role_id as role')
        ->first();
        if($user->vali== 1 && $user->role == 1){
            $ExpValidacionUsers= ExpValidacionUsers::where('exp_validacion_users.exp_id','=',$id)->first();
            return response()->json($ExpValidacionUsers);
        }
       
    }

    public function validar(Request $request)
    {
        $user = Persona::join('users','personas.user_id','users.id')
        ->join('egresados','personas.id','egresados.persona_id')
        ->join('roles_users','roles_users.user_id','users.id')
        ->where('users.id','=',auth()->user()->id)
        ->select('egresados.id as egresado','personas.validado as vali'
        ,'users.autorizado','users.validado','roles_users.role_id as role')
        ->first();
        if($user->vali== 1 && $user->role == 1){
            $ExpValidacionUsers = new ExpValidacionUsers();
            $ExpValidacionUsers->observaciones = $request->observaciones;
            $ExpValidacionUsers->fec_creac = $request->fec_creac;
            $ExpValidacionUsers->aprobado = $request->aprobado;
            $ExpValidacionUsers->exp_id  = $request->exp_id;
            $ExpValidacionUsers->user_admin_id  = auth()->user()->id;
            $ExpValidacionUsers->save();
            return response()->json($ExpValidacionUsers);
        }

        
    }
}
