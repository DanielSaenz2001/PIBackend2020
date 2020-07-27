<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PostgradosOtros;
use App\Persona;
class PostgradosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index','show']]);
    }
    public function index(Request $request)
    {
        $postgrado = PostgradosOtros::all();
        return response()->json($postgrado);
        
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
        if(($user->autorizado == 1 && $user->validado == 1) &&($user->vali== 1 && $user->role == 3)){
            $postgrado = new PostgradosOtros();
            $postgrado->agrado_academico = $request->agrado_academico;
            $postgrado->entidad = $request->entidad;
            $postgrado->descripcion = $request->descripcion;
            $postgrado->desde = $request->desde;
            $postgrado->hasta  = $request->hasta;
            $postgrado->evidencias  = $request->evidencias;
            $postgrado->egresado_id   = $user->egresado;
            $postgrado->save();
            return response()->json($postgrado);  
        }
        if(($user->role == 1)){
            $postgrado = new PostgradosOtros();
            $postgrado->agrado_academico = $request->agrado_academico;
            $postgrado->entidad = $request->entidad;
            $postgrado->descripcion = $request->descripcion;
            $postgrado->desde = $request->desde;
            $postgrado->hasta  = $request->hasta;
            $postgrado->evidencias  = $request->evidencias;
            $postgrado->egresado_id   = $request->egresado_id;
            $postgrado->save();
            return response()->json($postgrado);  
        }
        
    }
    public function show($id)
    {
        $postgrado= PostgradosOtros::findOrFail($id);
        return response()->json($postgrado);
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
        $postgrado = PostgradosOtros::findOrFail($id);
        if(($user->vali== 1 && $user->role == 3) &&($postgrado->egresado_id == $user->egresado)){
            $postgrado->agrado_academico = $request->agrado_academico;
            $postgrado->entidad = $request->entidad;
            $postgrado->descripcion = $request->descripcion;
            $postgrado->desde = $request->desde;
            $postgrado->hasta  = $request->hasta;
            $postgrado->evidencias  = $request->evidencias;
            $postgrado->save();
            return response()->json($postgrado);
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
        $post = PostgradosOtros::findOrFail($id);
        if(($user->autorizado == 1 && $user->validado == 1) &&($user->vali== 1 && $user->role == 3) &&($post->egresado_id== $user->egresado)){
            PostgradosOtros::findOrFail($id)->delete();
        }
    }
}
