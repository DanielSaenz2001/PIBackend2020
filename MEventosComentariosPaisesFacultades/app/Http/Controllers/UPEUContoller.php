<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Facultades;
use App\Escuelas;
use App\EgresadosEscuelas;

class UPEUContoller extends Controller
{
    public function facultades()
    {
        $facultades = Facultades::all(); 
        return response()->json($facultades);
    }
    public function escuelas()
    {
        $Escuelas = Escuelas::all(); 
        return response()->json($Escuelas);
    }
    public function egresadoescuela()
    {
        $EgresadosEscuelas = EgresadosEscuelas::all(); 
        return response()->json($EgresadosEscuelas);
    }
}
