<?php

namespace App\Http\Controllers;

use App\Persona;
use App\User;
use App\Egresados;
use App\EgresadosEscuelas;
use Illuminate\Http\Request;
use DB;
use App\Quotation;
class ValidadoresController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function Persona()
    {
        $result = User::join('personas', 'users.id', '=', 'personas.user_id')
        ->join('distritos', 'personas.distrito', '=', 'distritos.id')
        ->join('provincias', 'distritos.pro_id', '=', 'provincias.id')
        ->join('departamentos', 'provincias.dep_id', '=', 'departamentos.id')
        ->join('paises', 'departamentos.pais_id', '=', 'paises.id')
        
        ->where('users.id','=',auth()->user()->id)
        ->select('personas.nombre','personas.ap_materno',
        'personas.ap_paterno', 'paises.nombre as pais',
        'personas.email','personas.fec_nacimiento','personas.est_civil','personas.sexo' 
        ,'departamentos.nombre as departamentos','personas.id as persona_ID','users.id as user_ID','provincias.nombre as provincia', 'personas.dni',
        'personas.validado')
        ->first();
        return response()->json($result);
    }
    public function Rol()
    {
        $result = User::join('roles_users', 'users.id', '=', 'roles_users.user_id')
        ->join('roles', 'roles.id', '=', 'roles_users.role_id')
        ->where('users.id','=',auth()->user()->id)
        ->select('users.id as USERID','roles_users.role_id as ROLEID','roles.name as ROLENAME','users.autorizado','users.validado')
        ->first();
        return response()->json($result);
    }
    public function addEgresado(Request $request)
    {
        $no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
        $permitidas= array ("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");

        $request->pais_id = str_replace($no_permitidas, $permitidas ,$request->pais_id);
        $request->pais_id =strtoupper($request->pais_id);

        $request->departamento_id = str_replace($no_permitidas, $permitidas ,$request->departamento_id);
        $request->departamento_id =strtoupper($request->departamento_id);


        $request->provincia_id = str_replace($no_permitidas, $permitidas ,$request->provincia_id);
        $request->provincia_id =strtoupper($request->provincia_id);


        $request->distrito_id = str_replace($no_permitidas, $permitidas ,$request->distrito_id);
        $request->distrito_id =strtoupper($request->distrito_id);

        $pais_id            =     DB::table('paises')->where('nombre','=',$request->pais_id)->first();

        $departamento_id    =     DB::table('departamentos')->where('nombre','=',$request->departamento_id)->first();

        $provincia_id       =     DB::table('provincias')->where('nombre','=',$request->provincia_id)->first();

        $distrito_id        =     DB::table('distritos')->where('nombre','=',$request->distrito_id)->first();


        if( $pais_id == null){
            $paises = 1;
        }else{
            $paises = $pais_id->id;
        }

        if( $departamento_id == null){
            $departamentos = 1;
        }else{
            $departamentos = $departamento_id->id;
        }

        if( $provincia_id == null){
            $provincias = 1;
        }else{
            $provincias = $provincia_id->id;
        }

        if( $distrito_id == null){
            $distritos = 1;
        }else{
            $distritos = $distrito_id->id;
        }
        
        $egresados = Egresados::firstOrCreate([
            'codigo' => $request->codigo,
            'persona_id' => $request->persona_id,
        ], [
            'celular' => $request->celular,
            'direccion' => $request->direccion,
            'referencia' => $request->referencia,
            'pais_id' => $paises,
            'departamento_id' => $departamentos,
            'provincia_id' => $provincias,
            'distrito_id' => $distritos,
            'ingreso' => $request->ingreso,
            'egreso' => $request->egreso,
            'estado' => "0",
            'fecha_estado' => null,
        ]);
        return response()->json($egresados);
    }

    public function addEscuela(Request $request)
    {
        if($request->escuela_id == 'E.P. de Ingeniería de Sistemas - Filial Juliaca'){
            $request->escuela_id = 1;
        }

        $EgresadosEscuelas = EgresadosEscuelas::firstOrCreate([
            'egresado_id' => $request->egresado_id,
        ], [
            'escuela_id' => $request->escuela_id,
        ]);
        return response()->json($EgresadosEscuelas);
    }
}
