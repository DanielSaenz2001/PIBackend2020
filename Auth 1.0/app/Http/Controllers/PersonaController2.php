<?php

namespace App\Http\Controllers;

use App\Persona;
use App\User;
use Illuminate\Http\Request;

class PersonaController2 extends Controller
{


    public function updatepersonadi(Request $request, $id){
        $user = User::findOrFail($id);
        $user->validado = $request[0];
        $user->save();
        return response()->json($user);
    }
    
    public function PersonasNull(){
        $result = User::join('personas', 'personaid', '=', 'personas.id')
        ->where('users.id','=',auth()->user()->id)->first();
 
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
    }

    
    public function usuarios()
    {

        $users = User::join('personas', 'personaid', '=', 'personas.id')
        ->select('users.id','users.name as usuario','users.avatar','users.activo','users.email','users.rol',
        'personas.ap_paterno','personas.dni','personas.nombre'
        ,'personas.ap_materno')
        ->get();

        return response()->json($users);
    }
    public function usuariosAC(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->activo = $request->ac;
        $user->save();
        return response()->json($user);
    }
    public function usuariosROL(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->rol = $request->rol;
        $user->save();
        return response()->json($user);
    }
    public function egresados()
    {
        $persona = User::join('personas', 'users.id', '=', 'personas.user_id')
        ->join('distritos', 'personas.distrito', '=', 'distritos.id')
        ->join('provincias', 'distritos.pro_id', '=', 'provincias.id')
        ->join('departamentos', 'provincias.dep_id', '=', 'departamentos.id')
        ->join('paises', 'departamentos.pais_id', '=', 'paises.id')
        ->where('users.id','=',auth()->user()->id)
        ->select('users.id as User_id','personas.nombre','personas.ap_materno',
        'personas.ap_paterno', 'paises.nombre as pais',
        'personas.email','personas.fec_nacimiento','personas.est_civil','personas.sexo',
        'departamentos.nombre as departamento','personas.id as Persona_id','personas.validado',
        'provincias.nombre as provincia','distritos.nombre as distrito', 'personas.dni'
        )
        ->first();

        $imagen = User::join('personas', 'users.id', '=', 'personas.user_id')
        ->join('socials', 'users.id', '=', 'socials.user_id')
        ->where('users.id','=',auth()->user()->id)
        ->select('socials.avatar as imagen')
        ->first();

        $egresado = User::join('personas', 'users.id', '=', 'personas.user_id')
        ->join('egresados', 'personas.id', '=', 'egresados.persona_id')
        ->join('distritos', 'egresados.distrito_id', '=', 'distritos.id')
        ->join('provincias', 'distritos.pro_id', '=', 'provincias.id')
        ->join('departamentos', 'provincias.dep_id', '=', 'departamentos.id')
        ->join('paises', 'departamentos.pais_id', '=', 'paises.id')
        ->where('users.id','=',auth()->user()->id)
        ->select('paises.nombre as pais_domicilio','egresados.codigo'
        ,'egresados.celular','egresados.direccion','egresados.referencia',
        'departamentos.nombre as departamento_domicilio','provincias.nombre as provincia_domicilio',
        'distritos.nombre as distrito_domicilio','egresados.id as Egresado_id'
        ,'egresados.ingreso','egresados.estado','egresados.egreso')
        ->first();

        $escuelas = User::join('personas', 'users.id', '=', 'personas.user_id')
        ->join('egresados', 'personas.id', '=', 'egresados.persona_id')
        ->join('egresados_escuelas', 'egresados.id', '=', 'egresados_escuelas.egresado_id')
        ->join('escuelas', 'egresados_escuelas.escuela_id', '=', 'escuelas.id')
        ->join('facultades', 'escuelas.facultad_id', '=', 'facultades.id')
        ->where('users.id','=',auth()->user()->id)
        ->select('escuelas.nombre as escuela', 'facultades.nombre as facultad',
        'egresados_escuelas.id as Egresado_Escuela_id','escuelas.id as escuela_id','facultades.id as facultad_id')
        ->first();
        //return response()->json($result);
        return response()->json(['persona' => $persona, 
        'egresado' => $egresado,
        'escuela' => $escuelas,
        'imagen'=>$imagen]);
       
    }
    public function postgradosexperiencia(){

        $postgrados = User::join('personas', 'users.id', '=', 'personas.user_id')
        ->join('egresados', 'personas.id', '=', 'egresados.persona_id')
        ->join('postgrados_otros', 'egresados.id', '=', 'postgrados_otros.egresado_id')
        ->where('users.id','=',auth()->user()->id)
        ->select('postgrados_otros.id','postgrados_otros.agrado_academico','postgrados_otros.entidad'
        ,'postgrados_otros.descripcion','postgrados_otros.desde','postgrados_otros.evidencias'
        ,'postgrados_otros.egresado_id','postgrados_otros.hasta')
        ->get();

        $experiencia = User::join('personas', 'users.id', '=', 'personas.user_id')
        ->join('egresados', 'personas.id', '=', 'egresados.persona_id')
        ->join('experiencia_laborales', 'experiencia_laborales.egresado_id', '=', 'egresados.id')
        ->where('users.id','=',auth()->user()->id)
        ->select('experiencia_laborales.id','experiencia_laborales.empresa','experiencia_laborales.rubro_empresa'
        ,'experiencia_laborales.cargo_ocupar','experiencia_laborales.area','experiencia_laborales.inicio'
        ,'experiencia_laborales.final','experiencia_laborales.final','experiencia_laborales.descripcion','experiencia_laborales.satisfacion'
        ,'experiencia_laborales.egresado_id','egresados.estado as estado','experiencia_laborales.validado','experiencia_laborales.evidencia')
        ->get();

        $estado = User::join('personas', 'users.id', '=', 'personas.user_id')
        ->join('egresados', 'personas.id', '=', 'egresados.persona_id')
        ->where('users.id','=',auth()->user()->id)
        ->select('egresados.estado as estado')
        ->first();

        return response()->json(['postgrados' => $postgrados, 
        'experiencia' => $experiencia,
        'estado'=>$estado]);
    }

}
