<?php

namespace App\Http\Controllers;
use App\Persona;
use Illuminate\Http\Request;

class BuscarEgresadosController extends Controller
{

    public function EgresadoCodigo(Request $request)
    {
        $egresado = Persona::join('egresados', 'personas.id', '=', 'egresados.persona_id')
        ->join('egresados_escuelas','egresados_escuelas.egresado_id','egresados.id')
        ->join('escuelas','egresados_escuelas.escuela_id','escuelas.id')
        ->join('facultades','escuelas.facultad_id','facultades.id')
        ->where('egresados.codigo','=',$request->codigo)
        ->select('personas.nombre as nombre','personas.ap_materno',
        'personas.ap_paterno', 
        'personas.dni','escuelas.nombre as escuela','facultades.nombre as facultad',
        'egresados.codigo as codigo','egresados.estado as estado','egresados.celular as celular',
        'egresados.id','egresados.fecha_estado')->first();
        

        if($egresado !== null){
            return response()->json(['egresado' => $egresado, 
            'upeu' => null]);
        }
        if($egresado == null){
        $codigo =strval( $request->codigo );

        $data =json_decode( file_get_contents ('https://protected-ocean-96714.herokuapp.com/api/egresado/codigo/'.$codigo), true );
            if($data == null){
                return response()->json(['egresado' => null, 
                'upeu' => null]);
            }
            if($data !== null){
                return response()->json(['egresado' => null, 
                'upeu' => $data]);
            }
            
        }

    }

}
