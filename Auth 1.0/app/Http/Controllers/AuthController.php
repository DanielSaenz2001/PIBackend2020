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

    
}