<?php

namespace App\Http\Controllers;

use App\Persona;
use App\User;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    
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
        $persona->provincia = $request->provincia;
        $persona->dni = $request->dni;
        $persona->email = $request->email;
        $persona->fec_nacimiento = $request->fec_nacimiento;
        $persona->est_civil = $request->est_civil;
        $persona->sexo = $request->sexo;
        $persona->dependiente = $request->dependiente;
        $persona->save();
        return response()->json($persona);
    }
    public function show($id)
    {
        $persona= Persona::find($id);
        return response()->json($persona);
    }
    public function update(Request $request, $id)
    {
        persona::findOrFail($id)->update($request->all());
        return response()->json($request->all());
    }
    public function destroy($id)
    {
        persona::findOrFail($id)->delete();
    }
    public function me()
    {
        $result = User::join('personas', 'personaid', '=', 'personas.id')
        ->join('provincias', 'personas.provincia', '=', 'provincias.id')
        ->join('departamentos', 'provincias.dep_id', '=', 'departamentos.id')
        ->join('paises', 'departamentos.pais_id', '=', 'paises.id')
        
        
        ->where('users.id','=',auth()->user()->id)
        ->select('users.name as usuario','users.avatar','personas.nombre','personas.ap_materno','users.rol',
        'personas.ap_paterno', 'paises.nombre as pais',
        'personas.email','personas.fec_nacimiento','personas.est_civil','personas.sexo','personas.activo'
        ,'personas.dependiente','departamentos.nombre as departamentos','personas.id as persona_ID','users.id as user_ID','provincias.nombre as provincia', 'personas.dni')
        ->first();
        return response()->json($result);
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
    public function upload(Request $request){
        if ($request->hasFile('image'))
      {
        
        $file= $request->file('image'); 
        $name = time().$file->getClientOriginalName();
        $file->move(public_path().'/uploads/avatars',$name);
        $users = User::findOrFail($request->id);
        $users->avatar = $name;
        $users->save();
        return response()->json($users);

      } 
      else
      {
            return response()->json($request->id);
      }

     
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
}
