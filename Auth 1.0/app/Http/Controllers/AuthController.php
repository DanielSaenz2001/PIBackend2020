<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\SignUpRequest;
use App\User;
use DB;
use App\RolesUser;
use App\Egresados;
use App\Distritos;
use App\EgresadosEscuelas;
use Illuminate\Http\Request;

class AuthController extends Controller
{
      /**
     * Create a new AuthController instance. 
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'signup']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'El Correo o la contraseña estan erroneos.'], 401);
        }

        return $this->respondWithToken($token);

        //return response()->json(); 
    }

    public function signup(SignUpRequest $request)
    {
        $user = User::create($request->all());

        $roluser = new RolesUser();
        $roluser->role_id = 3;
        $roluser->user_id = $user->id;
        $roluser->save();
        return $this->login($request);

    }

    public function signupadministrador(Request $request)
    {
        $user = User::firstOrCreate([
            'email' => $request->email,
        ], [
            'password'=>  123456,
            'validado' => true,
            'autorizado'   => true,
            'active' => true,
        ]);

        RolesUser::firstOrCreate([
            'user_id' => $user->id,
        ], [
            'role_id'=>  3,
        ]);

        return response()->json($user->id);

    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()->id
        ]);
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