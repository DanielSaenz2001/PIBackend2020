<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ExperienciaLaborales;
class ExperienciaLaboralesController extends Controller
{
    public function index(Request $request)
    {
        $experiencia = ExperienciaLaborales::all();
        return response()->json($experiencia);
        
    }
    public function create(Request $request)
    {

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
    public function show($id)
    {
        $experiencia= ExperienciaLaborales::findOrFail($id);
        return response()->json($experiencia);
    }
    public function update(Request $request, $id)
    {
        $experiencia = ExperienciaLaborales::findOrFail($id);
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
    public function destroy($id)
    {
        ExperienciaLaborales::findOrFail($id)->delete();
    }
    

}
