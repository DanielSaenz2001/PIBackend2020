<?php

namespace App\Http\Controllers;

use App\Persona;
use App\Distritos;
use App\User;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index()
    {
        $persona = Persona::all(); 
        return response()->json($persona);
    }

    public function create(Request $request)
    {
        $persona = new Persona();
        $persona->nombre = $request->nombre;
        $persona->ap_paterno = $request->ap_paterno;
        $persona->ap_materno = $request->ap_materno;
        $persona->distrito = $request->distrito;
        $persona->dni = $request->dni;
        $persona->email = $request->email;
        $persona->fec_nacimiento = $request->fec_nacimiento;
        $persona->est_civil = $request->est_civil;
        $persona->sexo = $request->sexo;
        $persona->validado = 0;
        $persona->user_id = auth()->user()->id;
        $persona->save();

        $user = User::findOrFail(auth()->user()->id);
        $user->validado = 1;
        $user->save();
        return response()->json($persona);
    }


    public function createAdministrador(Request $request)
    {
        $user = User::join('roles_users', 'users.id', '=', 'roles_users.user_id')
        ->where('users.id','=',auth()->user()->id)
        ->select('roles_users.role_id as ROLEID','users.autorizado','users.validado')
        ->first();

        if($user->ROLEID == 1){
            $no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²","Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
            $permitidas= array ("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c","C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
            
            if($request->sexo=="M"){
                $request->sexo="Masculino";
            }
            if($request->sexo=="F"){
                $request->sexo="Femenino";
            }
            $request->distrito = str_replace($no_permitidas, $permitidas ,$request->distrito);
            $request->distrito =strtoupper($request->distrito);
            $distrito = Distritos::where('distritos.nombre','=',$request->distrito)->first();
    
    
            if($distrito==null){
                $persona = Persona::firstOrCreate([
                    'dni' => $request->dni,
                ], [
                    'nombre' => $request->nombre,
                    'ap_paterno' => $request->ap_paterno,
                    'ap_materno' => $request->ap_materno,
                    'distrito' => 1,
                    'email' => $request->email,
                    'fec_nacimiento' => $request->fec_nacimiento,
                    'est_civil' => $request->est_civil,
                    'sexo' => $request->sexo,
                    'validado' => 1,
                    'user_id' => $request->user_id,
                ]);
                return response()->json($persona);
            }
            $persona = Persona::firstOrCreate([
                'dni' => $request->dni,
            ], [
                'nombre' => $request->nombre,
                'ap_paterno' => $request->ap_paterno,
                'ap_materno' => $request->ap_materno,
                'distrito' => $distrito->id,
                'email' => $request->email,
                'fec_nacimiento' => $request->fec_nacimiento,
                'est_civil' => $request->est_civil,
                'sexo' => $request->sexo,
                'validado' => 1,
                'user_id' => $request->user_id,
            ]);
            return response()->json($persona);
        }
        return "no tienes personas";
        
    }

    public function show($id)
    {
        $persona= Persona::find($id);
        return response()->json($persona);
    }

    public function updatePersona(Request $request, $id)
    {
        $user = User::join('roles_users', 'users.id', '=', 'roles_users.user_id')
        ->join('personas', 'users.id', '=', 'personas.user_id')
        ->where('users.id','=',auth()->user()->id)
        ->select('roles_users.role_id as ROLEID','users.autorizado','users.validado','personas.id as personaid')
        ->first();
        if($user->ROLEID == 1){
            $persona = persona::findOrFail($id);
        }
        if($user->ROLEID == 3){
            $persona = persona::findOrFail($user->personaid);
        }
        $persona->est_civil = $request->est_civil;
        $persona->save();
        return response()->json($persona);
    }
}
