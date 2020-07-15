<?php

namespace App\Http\Controllers;

use App\Egresados;
use Illuminate\Http\Request;

class EgresadosController extends Controller
{
    
    public function egresadocodigo($id)
    {
        $egresado = Egresados::where('egresados.Codigo','=',$id)
        ->first();

        return response()->json($egresado);

    }
    public function index()
    {
        $egresados= Egresados::all();
        return response()->json($egresados);
    }
    public function show(Request $request,$id)
    {
        $egresados= Egresados::findOrFail($id);
        return response()->json($egresados);
    }



    

}
