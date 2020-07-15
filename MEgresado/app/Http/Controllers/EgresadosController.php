<?php

namespace App\Http\Controllers;
use App\Persona;
use App\User;
use App\Egresados;
use Illuminate\Http\Request;
use App\RolesUser;

class EgresadosController extends Controller
{
    public function index(Request $request)
    {
        $egresados = Persona::join('egresados', 'personas.id', '=', 'egresados.persona_id')
        ->join('egresados_escuelas','egresados_escuelas.egresado_id','egresados.id')
        ->join('escuelas','egresados_escuelas.escuela_id','escuelas.id')
        ->join('facultades','escuelas.facultad_id','facultades.id')
        ->select('personas.nombre as nombre','personas.ap_materno',
        'personas.ap_paterno', 
        'personas.dni','escuelas.nombre as escuela','facultades.nombre as facultad',
        'egresados.codigo as codigo','egresados.estado as estado','egresados.celular as celular',
        'egresados.id')->get();
        return response()->json($egresados);
        
    }

    public function PersonaEgresado(Request $request, $id)
    {
        $persona = Persona::findOrFail($id);
        $persona->validado = 1;
        $persona->save();
        return response()->json($persona);
    }

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

        $data =json_decode( file_get_contents ('http://localhost:9000/api/egresado/codigo/'.$codigo), true );
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

    public function create(Request $request)
    {

        $egresados = new Egresados();
        $egresados->codigo = $request->codigo;
        $egresados->celular = $request->celular;
        $egresados->direccion = $request->direccion;
        $egresados->referencia = $request->referencia;
        $egresados->pais_id  = $request->pais_id;
        $egresados->departamento_id  = $request->departamento_id;
        $egresados->provincia_id   = $request->provincia_id;
        $egresados->distrito_id   = $request->distrito_id;
        $egresados->persona_id  = $request->persona_id;
        $egresados->ingreso  = $request->ingreso;
        $egresados->egreso   = $request->egreso;
        $egresados->estado   = "0";
        $egresados->fecha_estado   = null;
        $egresados->save();
        return response()->json($egresados);
    }
    public function show($id)
    {
        $egresados= Egresados::findOrFail($id);
        return response()->json($egresados);
    }


    public function updateEgresado(Request $request, $id)
    {
        $egresados = Egresados::findOrFail($id);
        $egresados->celular = $request->celular;
        $egresados->direccion = $request->direccion;
        $egresados->referencia = $request->referencia;
        $egresados->pais_id  = $request->pais_id;
        $egresados->departamento_id  = $request->departamento_id;
        $egresados->provincia_id   = $request->provincia_id;
        $egresados->distrito_id   = $request->distrito_id;
        $egresados->save();
        return response()->json($egresados);
    }
    public function update(Request $request, $id)
    {
        $egresados = Egresados::findOrFail($id);
        $egresados->celular = $request->celular;
        $egresados->direccion = $request->direccion;
        $egresados->referencia = $request->referencia;
        $egresados->pais_id  = $request->pais_id;
        $egresados->departamento_id  = $request->departamento_id;
        $egresados->provincia_id   = $request->provincia_id;
        $egresados->persona_id  = $request->persona_id;
        $egresados->distrito_id   = $request->distrito_id;
        $egresados->save();
        return response()->json($egresados);
    }
    public function filtrarEgresado(Request $request)
    {
        $nombre =$request->nombre;
        $paterno =$request->ap_paterno;
        $materno =$request->ap_materno;
        $dni =$request->dni;
        $codigo =$request->codigo;
        $egreso =$request->egreso;
        $estado =$request->estado;

        $users = Persona::codigo($codigo)
        ->join('egresados', 'personas.id', '=', 'egresados.persona_id')
        ->join('egresados_escuelas','egresados_escuelas.egresado_id','egresados.id')
        ->join('escuelas','egresados_escuelas.escuela_id','escuelas.id')
        ->join('facultades','escuelas.facultad_id','facultades.id')
        ->name($nombre)
        ->dni($dni)
        ->paterno($paterno)
        ->materno($materno)
        ->egreso($egreso)
        ->estado($estado)

        
        ->select('personas.nombre as nombre','personas.ap_materno',
        'personas.ap_paterno', 
        'personas.dni','escuelas.nombre as escuela','facultades.nombre as facultad',
        'egresados.codigo as codigo','egresados.estado as estado','egresados.celular as celular',
        'egresados.id')
        ->get();

        return response()->json($users);
       
    }

    public function administrador(Request $request,$id)
    {
        $rol = RolesUser::where('user_id','=',$request->idusuario)->first();

        if($rol->role_id == "1" ){
            
        $persona = User::join('personas', 'users.id', '=', 'personas.user_id') 
        ->join('egresados', 'personas.id', '=', 'egresados.persona_id')
        ->join('distritos', 'personas.distrito', '=', 'distritos.id')
        ->join('provincias', 'distritos.pro_id', '=', 'provincias.id')
        ->join('departamentos', 'provincias.dep_id', '=', 'departamentos.id')
        ->join('paises', 'departamentos.pais_id', '=', 'paises.id')
        ->where('egresados.id','=',$id)
        ->select('users.id as User_id','personas.nombre','personas.ap_materno',
        'personas.ap_paterno', 'paises.nombre as pais',
        'personas.email','personas.fec_nacimiento','personas.est_civil','personas.sexo',
        'departamentos.nombre as departamento','personas.id as Persona_id','personas.validado',
        'provincias.nombre as provincia','distritos.nombre as distrito', 'personas.dni'
        )
        ->first();

        $imagen = User::join('personas', 'users.id', '=', 'personas.user_id')
        ->join('egresados', 'personas.id', '=', 'egresados.persona_id')
        ->join('socials', 'users.id', '=', 'socials.user_id')
        ->where('egresados.id','=',$id)
        ->select('socials.avatar as imagen')
        ->first();

        $egresado = User::join('personas', 'users.id', '=', 'personas.user_id')
        ->join('egresados', 'personas.id', '=', 'egresados.persona_id')
        ->join('distritos', 'egresados.distrito_id', '=', 'distritos.id')
        ->join('provincias', 'distritos.pro_id', '=', 'provincias.id')
        ->join('departamentos', 'provincias.dep_id', '=', 'departamentos.id')
        ->join('paises', 'departamentos.pais_id', '=', 'paises.id')
        ->where('egresados.id','=',$id)
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
        ->where('egresados.id','=',$id)
        ->select('escuelas.nombre as escuela', 'facultades.nombre as facultad',
        'egresados_escuelas.id as Egresado_Escuela_id','escuelas.id as escuela_id','facultades.id as facultad_id')
        ->first();

        $postgrados = User::join('personas', 'users.id', '=', 'personas.user_id')
        ->join('egresados', 'personas.id', '=', 'egresados.persona_id')
        ->join('postgrados_otros', 'egresados.id', '=', 'postgrados_otros.egresado_id')
        ->where('egresados.id','=',$id)
        ->select('postgrados_otros.id','postgrados_otros.agrado_academico','postgrados_otros.entidad'
        ,'postgrados_otros.descripcion','postgrados_otros.desde','postgrados_otros.evidencias'
        ,'postgrados_otros.egresado_id','postgrados_otros.hasta')
        ->get();

        $experiencia = User::join('personas', 'users.id', '=', 'personas.user_id')
        ->join('egresados', 'personas.id', '=', 'egresados.persona_id')
        ->join('experiencia_laborales', 'experiencia_laborales.egresado_id', '=', 'egresados.id')
        ->where('egresados.id','=',$id)
        ->select('experiencia_laborales.id','experiencia_laborales.empresa','experiencia_laborales.rubro_empresa'
        ,'experiencia_laborales.cargo_ocupar','experiencia_laborales.area','experiencia_laborales.inicio'
        ,'experiencia_laborales.final','experiencia_laborales.final','experiencia_laborales.descripcion','experiencia_laborales.satisfacion'
        ,'experiencia_laborales.egresado_id','egresados.estado as estado','experiencia_laborales.validado','experiencia_laborales.evidencia')
        ->get();

        $estado = User::join('personas', 'users.id', '=', 'personas.user_id')
        ->join('egresados', 'personas.id', '=', 'egresados.persona_id')
        ->where('egresados.id','=',$id)
        ->select('egresados.estado as estado')
        ->first();

        return response()->json([
        'egresado' => $egresado, 
        'escuela' => $escuelas,  
        'persona' => $persona,   
        'imagen' => $imagen,   
        'postgrados' => $postgrados, 
        'experiencia' => $experiencia,
        'estado'=>$estado]);

        }
        return "no tengo permisos";
    }
    

}
