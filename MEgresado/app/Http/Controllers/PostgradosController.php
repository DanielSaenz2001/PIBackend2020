<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PostgradosOtros;
class PostgradosController extends Controller
{
    public function index(Request $request)
    {
        $postgrado = PostgradosOtros::all();
        return response()->json($postgrado);
        
    }
    public function create(Request $request)
    {

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
    public function show($id)
    {
        $postgrado= PostgradosOtros::findOrFail($id);
        return response()->json($postgrado);
    }
    public function update(Request $request, $id)
    {
        $postgrado = PostgradosOtros::findOrFail($id);
        $postgrado->agrado_academico = $request->agrado_academico;
        $postgrado->entidad = $request->entidad;
        $postgrado->descripcion = $request->descripcion;
        $postgrado->desde = $request->desde;
        $postgrado->hasta  = $request->hasta;
        $postgrado->evidencias  = $request->evidencias;
        $postgrado->save();
        return response()->json($postgrado);
    }
    public function destroy($id)
    {
        PostgradosOtros::findOrFail($id)->delete();
    }
    

}
