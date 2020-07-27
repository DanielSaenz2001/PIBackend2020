<?php

namespace App\Http\Controllers;
use App\Comentarios;
use App\User;
use App\RolesUser;
use Illuminate\Http\Request;

class ComentariosController extends Controller
{public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index','indexNorespuesta','show','showRespuesta','norespuesta']]);
    }
    public function index(Request $request)
    {

        $result = Comentarios::join('users', 'user_id', '=', 'users.id')
        ->join('personas', 'users.id', '=', 'personas.user_id')
        ->select('personas.nombre','personas.ap_materno','personas.ap_paterno', 'comentarios.id',
        'comentarios.descripcionEgresado','comentarios.fecha_creacion','comentarios.respuesta', 'comentarios.user_id','comentarios.opcional' )
        ->orderBy('comentarios.fecha_creacion','asc')
        ->get();
        return response()->json($result);
        
    }
    public function indexNorespuesta(Request $request)
    {
        
        $result = Comentarios::join('users', 'user_id', '=', 'users.id')
        ->join('personas', 'users.id', '=', 'personas.user_id')
        ->where('comentarios.respuesta','=','0')
        ->select('personas.nombre','personas.ap_materno','personas.ap_paterno', 'comentarios.id',
        'comentarios.descripcionEgresado','comentarios.fecha_creacion','comentarios.respuesta','comentarios.opcional')
        ->orderBy('comentarios.fecha_creacion','asc')
        ->get();
        return response()->json($result);
        
    }

    public function create(Request $request)
    {
        $user = User::join('roles_users', 'users.id', '=', 'roles_users.user_id')
        ->where('users.id','=',auth()->user()->id)
        ->select('roles_users.role_id as ROLEID','users.autorizado','users.validado')
        ->first();

        if($user->autorizado == 1 && $user->autorizado == 1){
            $comentarios = new Comentarios();
            $comentarios->descripcionEgresado = $request->descripcionEgresado;
            $comentarios->fecha_creacion = $request->fecha_creacion;
            $comentarios->tipo = $request->tipo;
            $comentarios->opcional = $request->opcional;
            $comentarios->user_id = auth()->user()->id;
            $comentarios->save();

            return response()->json($comentarios);
        }
    }
    public function show($id)
    {
        $comentarios= Comentarios::findOrFail($id);

        return response()->json($comentarios);

        
    }

    public function showRespuesta($id)
    {
        $result = Comentarios::join('users', 'user_id', '=', 'users.id')
        ->join('personas', 'users.id', '=', 'personas.user_id')
        ->where('comentarios.id','=',$id)
        ->select('personas.nombre','personas.ap_materno','personas.ap_paterno', 'comentarios.id',
        'comentarios.descripcionEgresado','comentarios.fecha_creacion','comentarios.respuesta',
        'comentarios.descripcionAdministrador','comentarios.opcional' )
        ->orderBy('comentarios.fecha_creacion','asc')
        ->first();
        return response()->json($result);
    }

    public function update(Request $request, $id)
    {
        $user = User::join('roles_users', 'users.id', '=', 'roles_users.user_id')
        ->where('users.id','=',auth()->user()->id)
        ->select('roles_users.role_id as ROLEID','users.autorizado','users.validado')
        ->first();
        $comentarios = Comentarios::findOrFail($id);
        if(($request->user_id  == auth()->user()->id)  &&($user->autorizado == 1 && $user->autorizado == 1) && $comentarios->respuesta==0){
            
            $comentarios->descripcionEgresado = $request->descripcionEgresado;
            $comentarios->fecha_creacion = $request->fecha_creacion;
            $comentarios->tipo = $request->tipo;
            $comentarios->opcional = $request->opcional;
            $comentarios->user_id = $request->user_id;
            $comentarios->save();
            return response()->json($comentarios);
        }
        
    }

    public function Respuesta(Request $request, $id)
    {
        $user = User::join('roles_users', 'users.id', '=', 'roles_users.user_id')
        ->where('users.id','=',auth()->user()->id)
        ->select('roles_users.role_id as ROLEID','users.autorizado','users.validado')
        ->first();
        $comentarios = Comentarios::findOrFail($id);
        if($user->ROLEID == 1 && $comentarios->respuesta == 0){
            $comentarios->descripcionAdministrador = $request->descripcionAdministrador;
            $comentarios->respuesta = 1;
            $comentarios->save();
            return response()->json($comentarios);
        }
    }

    public function destroy($id)
    {
        $user = User::join('roles_users', 'users.id', '=', 'roles_users.user_id')
        ->where('users.id','=',auth()->user()->id)
        ->select('roles_users.role_id as ROLEID','users.autorizado','users.validado')
        ->first();
        $comentarios = Comentarios::findOrFail($id);
        if($user->ROLEID == 1 &&   $comentarios->respuesta == 0){
           $comentarios ->delete();
        }
        if($user->ROLEID == 3 &&  ($comentarios->respuesta == 0 && $comentarios->user_id== auth()->user()->id)){
            $comentarios ->delete();
         }
    }
    public function norespuesta(){
        $result = Comentarios::where('respuesta','=','0')->get();
        return response()->json($result);
    }
}
