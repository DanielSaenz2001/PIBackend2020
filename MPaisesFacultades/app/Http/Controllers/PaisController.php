<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Paises;
use App\Departamentos;
use App\Provincia;
use App\Distrito;
use App\Lugares;
class PaisController extends Controller
{
    public function paises()
    {
        $paises = Paises::all(); 
        return response()->json($paises);
    }
    public function provincias()
    {
        $provincia = Provincia::all(); 
        return response()->json($provincia);
    }
    public function departamentos()
    {
        $departamentos = Departamentos::all(); 
        return response()->json($departamentos);
    }
    public function lugares()
    {
        $lugares = Lugares::all(); 
        return response()->json($lugares);
    }
    public function distritos()
    {
        $distritos = Distrito::all(); 
        return response()->json($distritos);
    }
}
