<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ExperienciaLaborales;
use App\ExpValidacionUsers;
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
    public function vervalidacion($id)
    {
        $ExpValidacionUsers= ExpValidacionUsers::where('exp_validacion_users.exp_id','=',$id)->first();
        return response()->json($ExpValidacionUsers);
    }

    public function validar(Request $request)
    {

        $ExpValidacionUsers = new ExpValidacionUsers();
        $ExpValidacionUsers->observaciones = $request->observaciones;
        $ExpValidacionUsers->fec_creac = $request->fec_creac;
        $ExpValidacionUsers->aprobado = $request->aprobado;
        $ExpValidacionUsers->exp_id  = $request->exp_id;
        $ExpValidacionUsers->user_admin_id  = $request->user_admin_id;
        $ExpValidacionUsers->save();
        return response()->json($ExpValidacionUsers);
    }
}
