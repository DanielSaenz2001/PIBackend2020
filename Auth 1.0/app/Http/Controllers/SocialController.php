<?php

namespace App\Http\Controllers;

use App\Social;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Laravel\Socialite\Facades\Socialite;
use Tymon\JWTAuth\Facades\JWTAuth;
use Validator,Redirect,Response,File;


class SocialController extends Controller
{
    //
    public function getSocialRedirect($provider)
    {

        $providerKey = Config::get('services.' . $provider);

        if (empty($providerKey)) {
            return response()->error('invalid_social_provider', 404);
        }

        return Socialite::driver($provider)->redirect();
    }



    public function getSocialHandle(Request $request, $provider)
    {
        if ($request->has('code')) {
            $providerUser = Socialite::driver('google')->user();
        } else {
            return response()->error('social_access_denied', 401);
        }
        
        if (explode("@", $providerUser->email)[1] !== 'upeu.edu.pe') {
            return redirect()->to('http://localhost:4200/')->withErrors([
                'email' => 'You must be a member of the 131Studios Organization to Login',
            ]);

        }
        $account = Social::whereProvider($provider)
                        ->whereProviderUserId($providerUser->id)
                        ->first();
        if ($account) {

            $user = $account->user;
        } else {
            $account = new Social([
                'provider_user_id' => $providerUser->id,
                'provider'         => $provider,
                'avatar'           => $providerUser->avatar,
            ]);

            $user = User::firstOrCreate([
                'email' => $providerUser->email,
            ], [
                'role'   => 'user',
                'name'   => $providerUser->name,
                'active' => true,
            ]);
            

            // para relaciones "belongTo" o "oneToMany" inversa
            $account->user()->associate($user);
            $account->save();
        }
        try
        {
            // "como es cuenta ya verificada, no recibirá email de activacion"
            $user->active = 1;



            $user->avatar = $account->avatar;

            $token = JWTAuth::fromUser($user);

            return redirect()->to('http://localhost:4200/?token='.$token);

            

        } catch (Exception $e) {
            return response()->error('error_on_login_user', $e->getStatusCode());
        }
    }

    public function login($token)
    {

        

        return $this->respondWithToken($token);
    }
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()->name
        ]);
    }
}
