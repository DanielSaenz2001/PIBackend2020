<?php

namespace App\Http\Controllers;
use App\Persona;
use App\Egresados;
use Illuminate\Http\Request;

class EgresadosController extends Controller
{
    public function index(Request $request)
    {
        $egresados = Egresados::all();
        return response()->json($egresados);
        
    }

    public function PersonaEgresado(Request $request, $id)
    {
        $persona = Persona::findOrFail($id);
        $persona->validado = 1;
        $persona->save();
        return response()->json($persona);
    }
    
    public function create(Request $request)
    {

        $egresados = new Egresados();
        $egresados->codigo = $request->codigo;
        $egresados->celular = $request->celular;
        $egresados->direccion = $request->direccion;
        $egresados->referencia = $request->referencia;
        $egresados->pais_id  = $request->pais_id;
        $egresados->departamento_id  = $request->departamento_id;
        $egresados->provincia_id   = $request->provincia_id;
        $egresados->distrito_id   = $request->distrito_id;
        $egresados->persona_id  = $request->persona_id;
        $egresados->ingreso  = $request->ingreso;
        $egresados->egreso   = $request->egreso;
        $egresados->estado   = "0";
        $egresados->save();
        return response()->json($egresados);
    }
    public function show($id)
    {
        $egresados= Egresados::findOrFail($id);
        return response()->json($egresados);
    }
    public function update(Request $request, $id)
    {
        $egresados = Egresados::findOrFail($id);
        $egresados->celular = $request->celular;
        $egresados->direccion = $request->direccion;
        $egresados->referencia = $request->referencia;
        $egresados->pais_id  = $request->pais_id;
        $egresados->departamento_id  = $request->departamento_id;
        $egresados->provincia_id   = $request->provincia_id;
        $egresados->persona_id  = $request->persona_id;
        $egresados->save();
        return response()->json($egresados);
    }
    public function filtrarEgresado(Request $request)
    {
        $nombre =$request->nombre;
        $paterno =$request->ap_paterno;
        $materno =$request->ap_materno;
        $dni =$request->dni;
        $codigo =$request->codigo;
        $egreso =$request->egreso;
        $estado =$request->estado;

        $users = Persona::codigo($codigo)
        ->name($nombre)
        ->dni($dni)
        ->paterno($paterno)
        ->materno($materno)
        ->egreso($egreso)
        ->estado($estado)
        ->get();
        /*$users = Persona::name($nombre)
        ->join('users', 'personas.user_id', '=', 'users.id')
        ->join('egresados','personas.id','egresados.persona_id')
        ->dni($dni)
        ->paterno($paterno)
        ->materno($materno)
        ->select('personas.nombre','personas.ap_materno',
        'personas.ap_paterno', 
        'personas.dni','egresados.codigo as codigo','egresados.egreso')->get();*/
        return response()->json($users);
       
    }

}
