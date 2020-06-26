<?php

namespace App\Http\Controllers;
use App\Comentarios;
use App\User;
use App\RolesUser;
use Illuminate\Http\Request;

class ComentariosController extends Controller
{
    public function index(Request $request)
    {
        $comentarios = Comentarios::all();
        
        $result = Comentarios::join('users', 'user_id', '=', 'users.id')
        ->join('personas', 'users.id', '=', 'personas.user_id')
        ->select('personas.nombre','personas.ap_materno','personas.ap_paterno', 'comentarios.id',
        'comentarios.descripcionEgresado','comentarios.fecha_creacion','comentarios.respuesta', 'comentarios.user_id')
        ->orderBy('comentarios.fecha_creacion','asc')
        ->get();
        return response()->json($result);
        
    }
    public function indexNorespuesta(Request $request)
    {
        $comentarios = Comentarios::all();
        
        $result = Comentarios::join('users', 'user_id', '=', 'users.id')
        ->join('personas', 'users.id', '=', 'personas.user_id')
        ->where('comentarios.respuesta','=','0')
        ->select('personas.nombre','personas.ap_materno','personas.ap_paterno', 'comentarios.id',
        'comentarios.descripcionEgresado','comentarios.fecha_creacion','comentarios.respuesta')
        ->orderBy('comentarios.fecha_creacion','asc')
        ->get();
        return response()->json($result);
        
    }

    public function create(Request $request)
    {

        $comentarios = new Comentarios();
        $comentarios->descripcionEgresado = $request->descripcionEgresado;
        $comentarios->fecha_creacion = $request->fecha_creacion;
        $comentarios->tipo = $request->tipo;
        $comentarios->opcional = $request->opcional;
        $comentarios->user_id = $request->user_id;
        $comentarios->save();
        return response()->json($comentarios);
    }
    public function show($id)
    {
        $comentarios= Comentarios::findOrFail($id);

        return response()->json($comentarios);

        
    }

    public function showRespuesta($id)
    {
        $result = Comentarios::join('users', 'user_id', '=', 'users.id')
        ->join('personas', 'users.personaid', '=', 'personas.id')
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
        $comentarios = Comentarios::findOrFail($id);
        $comentarios->descripcionEgresado = $request->descripcionEgresado;
        $comentarios->fecha_creacion = $request->fecha_creacion;
        $comentarios->tipo = $request->tipo;
        $comentarios->opcional = $request->opcional;
        $comentarios->user_id = $request->user_id;
        $comentarios->save();
        return response()->json($comentarios);
    }

    public function Respuesta(Request $request, $id)
    {
        $comentarios = Comentarios::findOrFail($id);
        $comentarios->descripcionAdministrador = $request->descripcionAdministrador;
        $comentarios->respuesta = 1;
        $comentarios->save();
        return response()->json($comentarios);
    }

    public function destroy($id)
    {
        Comentarios::findOrFail($id)->delete();
    }
    public function norespuesta(){
        $result = Comentarios::where('respuesta','=','0')->get();
        return response()->json($result);
    }
}
