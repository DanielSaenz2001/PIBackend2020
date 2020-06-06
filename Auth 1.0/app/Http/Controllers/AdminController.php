<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Persona;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function persona($id)
    {
        if(auth()->user()->rol == 1){
            $result = User::join('personas', 'personaid', '=', 'personas.id')
            ->join('provincias', 'personas.provincia', '=', 'provincias.id')
            ->join('departamentos', 'provincias.dep_id', '=', 'departamentos.id')
            ->join('paises', 'departamentos.pais_id', '=', 'paises.id')
            
            
            ->where('users.id','=',$id)
            ->select('users.name as usuario','users.avatar','personas.nombre','personas.ap_materno','users.rol',
            'personas.ap_paterno', 'paises.nombre as pais',
            'personas.email','personas.fec_nacimiento','personas.est_civil','personas.sexo','personas.activo'
            ,'personas.dependiente','departamentos.nombre as departamentos','personas.id as persona_ID','users.id as user_ID','provincias.nombre as provincia', 'personas.dni')
            ->first();
            return response()->json($result);
        }else{
            return response()->json($id);
            
        }
        
    }
    public function dependiente($id){
        if(auth()->user()->rol == 1){
        $result = User::join('personas', 'personaid', '=', 'personas.id')
        ->where('users.id','=',$id)->first();
 
         $resultado = Persona::join('provincias', 'personas.provincia', '=', 'provincias.id')
        ->join('departamentos', 'provincias.dep_id', '=', 'departamentos.id')
        ->join('paises', 'departamentos.pais_id', '=', 'paises.id')
        ->where([['personas.dependiente','=',$result->id]])

        ->select('personas.nombre','personas.ap_materno',
        'personas.ap_paterno', 'paises.nombre as pais',
        'personas.email','personas.fec_nacimiento','personas.est_civil','personas.sexo'
        ,'personas.dependiente','departamentos.nombre as departamentos','personas.id as persona_ID','provincias.nombre as provincia')
        ->get();

        return response()->json($resultado); 
        }else{
            return response()->json($id);
        }
    }
    public function egresado($id){
        if(auth()->user()->rol == 1){
        $result = User::join('personas', 'personaid', '=', 'personas.id')
         ->join('egresados', 'egresados.persona_id', '=', 'personas.id')
         ->join('provincias', 'egresados.domicilio_actual', '=', 'provincias.id')
         ->join('departamentos', 'provincias.dep_id', '=', 'departamentos.id')
         ->join('paises', 'departamentos.pais_id', '=', 'paises.id')
         ->where('users.id','=',$id)
         ->select('users.name as usuario','users.avatar','personas.nombre','personas.ap_materno',
         'personas.ap_paterno', 'paises.nombre as pais',
         'personas.email','personas.sexo'
         ,'personas.dependiente','departamentos.nombre as departamentos','personas.id as persona_ID','users.id as user_ID','provincias.nombre as provincia', 'personas.dni'
         ,'egresados.codigo','egresados.celular','egresados.id')
         ->first();
         return response()->json($result);
        }else{
            return response()->json($id);
        }
     }
 
     public function egresadoescuela($id){
        if(auth()->user()->rol == 1){
         $result = User::join('personas', 'personaid', '=', 'personas.id')
          ->join('egresados', 'egresados.persona_id', '=', 'personas.id')
          ->join('egresado_escuelas', 'egresado_escuelas.egresado_id', '=', 'egresados.id')
          ->join('escuela_profecionales', 'egresado_escuelas.escuela_profesiona_id', '=', 'escuela_profecionales.id')
          ->join('facultades', 'escuela_profecionales.facultad_id', '=', 'facultades.id')
          ->where('users.id','=',$id)
          ->select('facultades.nombre as facultad','escuela_profecionales.nombre as escuela','egresado_escuelas.fecha_ingreso','egresado_escuelas.fecha_egreso',
          'egresado_escuelas.descripcion')
          ->get();
          return response()->json($result);
        }else{
            return response()->json($id);
        }
      }
      public function formaciones($id){
        if(auth()->user()->rol == 1){
        $result = User::join('personas', 'personaid', '=', 'personas.id')
        ->join('egresados', 'egresados.persona_id', '=', 'personas.id')
        ->join('formaciones_basicas', 'formaciones_basicas.egresado_id', '=', 'egresados.id')
        ->where('users.id','=',$id)
        ->select('formaciones_basicas.id','formaciones_basicas.nombre','formaciones_basicas.fech_inicio','formaciones_basicas.fech_fin','formaciones_basicas.rutas')
        ->get();
        return response()->json($result);
        }else{
            return response()->json($id);
        }
    }
    public function capacitaciones($id){
        if(auth()->user()->rol == 1){
        $result = User::join('personas', 'personaid', '=', 'personas.id')
        ->join('egresados', 'egresados.persona_id', '=', 'personas.id')
        ->join('capacitaciones', 'capacitaciones.egresado_id', '=', 'egresados.id')
        ->where('users.id','=',$id)
        ->select('capacitaciones.id','capacitaciones.nombre','capacitaciones.informacion',
        'capacitaciones.fecha_inicio','capacitaciones.fecha_fin','capacitaciones.direccion',
        'capacitaciones.tipo','capacitaciones.precio','capacitaciones.rutas')
        ->get();
        return response()->json($result);
    }else{
        return response()->json($id);
    }
    }
    public function empresas($id){
        if(auth()->user()->rol == 1){
        $result = User::join('personas', 'personaid', '=', 'personas.id')
        ->join('egresados', 'egresados.persona_id', '=', 'personas.id')
        ->join('empresas', 'empresas.egresado', '=', 'egresados.id')
        ->where('users.id','=',$id)
        ->select('empresas.id','empresas.nombre','empresas.telefono','empresas.tipo','empresas.direccion','empresas.correo')
        ->get();
        return response()->json($result);
    }else{
        return response()->json($id);
    }
    }
    public function experiencia($id){
        if(auth()->user()->rol == 1){
        $result = User::join('personas', 'personaid', '=', 'personas.id')
        ->join('egresados', 'egresados.persona_id', '=', 'personas.id')
        ->join('experiencias_laborales', 'experiencias_laborales.egresado_id', '=', 'egresados.id')
        ->join('empresas', 'experiencias_laborales.empresa_id', '=', 'empresas.id')
        ->where('users.id','=',$id)
        ->select('experiencias_laborales.id','experiencias_laborales.validacion_fecha','experiencias_laborales.is_validando',
        'experiencias_laborales.descripcion_val','empresas.nombre as empresa')
        ->get();
        return response()->json($result);
        }else{
            return response()->json($id);
        }
    }
    
}
