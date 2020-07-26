<?php

namespace App\Http\Controllers;

use App\Social;
use App\User;
use Carbon\Carbon;
use App\RolesUser;
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
            $providerUser = Socialite::driver($provider)->user();
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
                'password'=>  null,
                'validado' => FALSE,
                'autorizado'   => true,
                'name'   => $providerUser->name,
                'active' => true,
            ]);

            // para relaciones "belongTo" o "oneToMany" inversa
            $account->user()->associate($user);
            $account->save();

            $roluser = new RolesUser();
            $roluser->role_id = 3;
            $roluser->user_id = $user->id;
            $roluser->save();
        }
        try
        {
            // "como es cuenta ya verificada, no recibirá email de activacion"
            $user->active = 1;
            $emial = $providerUser->email;
            // emitimos evento de logueado
            //event(new \Illuminate\Auth\Events\Login($user, true));

            $user->avatar = $account->avatar;

            $token = JWTAuth::fromUser($user);

            //return response()->success(compact('user', 'token'));
            auth()->login($user);
            //return response()->json($user->id);
            return redirect()->to('http://localhost:4200/?token='.$token.'&ema='.$emial);

        } catch (Exception $e) {
            return response()->error('error_on_login_user', $e->getStatusCode());
        }
    }
}
