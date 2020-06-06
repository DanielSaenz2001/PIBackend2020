<?php

namespace App\Http\Controllers;

use App\Imagen;
use Illuminate\Http\Request;

class ImagenController extends Controller
{
    public function index()
    {
        $CrearImagen = Imagen::all(); 
        return response()->json($CrearImagen);
    }

    public function create(Request $request)
    {
        $CrearImagen = new Imagen();
        $CrearImagen->url = $request->urlImagen;
        $CrearImagen->detalle = $request->detalleImagen;
        $CrearImagen->es_principal = $request->es_principalImagen;
        $CrearImagen->orden = $request->ordenImagen;
        $CrearImagen->catalogoid = $request->catalogoidImagen;
        $CrearImagen->save();
        return response()->json($CrearImagen);
    }
    public function show($id)
    {
        $CrearImagen= Imagen::find($id);
        return response()->json($CrearImagen);
    }
    public function update(Request $request, $id)
    {
        Imagen::findOrFail($id)->update($request->all());
        return response()->json($request->all());
    }
    public function destroy($id)
    {
        Imagen::findOrFail($id)->delete();
    }
}
