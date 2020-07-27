<?php

namespace App\Http\Controllers;
use App\Eventos;
use App\User;
use App\RolesUser;
use Illuminate\Http\Request;

class EventosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index','show','visibles']]);
    }
    public function index(Request $request)
    {
        $eventos = Eventos::all();
        return response()->json($eventos);
        
    }

    public function create(Request $request)
    {
        $user = User::join('roles_users', 'users.id', '=', 'roles_users.user_id')
        ->where('users.id','=',auth()->user()->id)
        ->select('roles_users.role_id as ROLEID','users.autorizado','users.validado')
        ->first();

        if($user->ROLEID == 1){
            $evento = new Eventos();
            $evento->titulo = $request->titulo;
            $evento->link = $request->link;
            $evento->fecha_inicio = $request->fecha_inicio;
            $evento->fecha_fin = $request->fecha_fin;
            $evento->descripcion = $request->descripcion;
            $evento->lugar = $request->lugar;
            $evento->save();
            return response()->json($evento);
        }
        
    }
    public function show($id)
    {
        $evento= Eventos::findOrFail($id);
        return response()->json($evento);
    }
    public function update(Request $request, $id)
    {
        $user = User::join('roles_users', 'users.id', '=', 'roles_users.user_id')
        ->where('users.id','=',auth()->user()->id)
        ->select('roles_users.role_id as ROLEID','users.autorizado','users.validado')
        ->first();

        if($user->ROLEID == 1){
            $evento = Eventos::findOrFail($id);
            $evento->titulo = $request->titulo;
            $evento->link = $request->link;
            $evento->fecha_inicio = $request->fecha_inicio;
            $evento->fecha_fin = $request->fecha_fin;
            $evento->descripcion = $request->descripcion;
            $evento->lugar = $request->lugar;
            $evento->visible = $request->visible;
            $evento->save();
            return response()->json($evento);
        }
       
    }
    public function destroy($id)
    {
        $user = User::join('roles_users', 'users.id', '=', 'roles_users.user_id')
        ->where('users.id','=',auth()->user()->id)
        ->select('roles_users.role_id as ROLEID','users.autorizado','users.validado')
        ->first();

        if($user->ROLEID == 1){
            Eventos::findOrFail($id)->delete();
        }
        
    }
    public function visibles(){
        $result = Eventos::where('visible','=','1')->get();
        return response()->json($result);
    }
}
