<?php

namespace App\Http\Controllers;
use App\Eventos;
use App\User;
use App\RolesUser;
use Illuminate\Http\Request;

class EventosController extends Controller
{
    public function index(Request $request)
    {
        $userid = $request->header('id');
        
        $rol = RolesUser::where('user_id','=',$userid)->first();

        if($rol->role_id == "1" ){
            $eventos = Eventos::all();
            return response()->json($eventos);
        }else{
            return "no tengo permisos";
        }
        
    }

    public function create(Request $request)
    {

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
    public function show($id)
    {
        $evento= Eventos::findOrFail($id);
        return response()->json($evento);
    }
    public function update(Request $request, $id)
    {
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
    public function destroy($id)
    {
        Eventos::findOrFail($id)->delete();
    }
    public function visibles(){
        $result = Eventos::where('visible','=','1')->get();
        return response()->json($result);
    }
}
