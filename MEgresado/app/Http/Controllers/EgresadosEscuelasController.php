<?php

namespace App\Http\Controllers;
use App\EgresadosEscuelas;
use Illuminate\Http\Request;

class EgresadosEscuelasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['show']]);
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
            $EgresadosEscuelas = new EgresadosEscuelas();
            $EgresadosEscuelas->egresado_id = $user->egresado;
            $EgresadosEscuelas->escuela_id = $request->escuela_id;
            $EgresadosEscuelas->save();
            return response()->json($EgresadosEscuelas);
        }
        
    }
    public function show($id)
    {
        $EgresadosEscuelas= EgresadosEscuelas::findOrFail($id);
        return response()->json($EgresadosEscuelas);
    }

}
