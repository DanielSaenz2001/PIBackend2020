<?php

namespace App\Http\Controllers;
use App\EgresadosEscuelas;
use Illuminate\Http\Request;

class PruebaController extends Controller
{
    
    public function me(Request $request)
    {
        $header = $request->header('noooooo');
        return response()->json($header);
        return response()->json(auth()->user());
    }
}
