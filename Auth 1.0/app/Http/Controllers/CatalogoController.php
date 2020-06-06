<?php

namespace App\Http\Controllers;

use App\Catalogo;
use Illuminate\Http\Request;

class CatalogoController extends Controller
{
    public function index()
    {
        $CrearCatalogo = Catalogo::all(); 
        return response()->json($CrearCatalogo);
    }

    public function create(Request $request)
    {
        $CrearCatalogo = new Catalogo();
        $CrearCatalogo->nombre = $request->nombreCatalogo;
        $CrearCatalogo->codigo = $request->codigoCatalogo;
        $CrearCatalogo->precio = $request->precioCatalogo;
        $CrearCatalogo->orden = $request->ordenCatalogo;
        $CrearCatalogo->save();
        return response()->json($CrearCatalogo);
    }
    public function show($id)
    {
        $CrearCatalogo= Catalogo::find($id);
        return response()->json($CrearCatalogo);
    }
    public function update(Request $request, $id)
    {
        Catalogo::findOrFail($id)->update($request->all());
        return response()->json($request->all());
    }
    public function destroy($id)
    {
        Catalogo::findOrFail($id)->delete();
    }
}
