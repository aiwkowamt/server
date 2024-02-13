<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->stateless()->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $githubUser = Socialite::driver($provider)->stateless()->user();

        if (!$githubUser) {
            $user = User::firstOrCreate(
                ['provider_id' => $githubUser->getId()],
                [
                    'first_name' => $githubUser->getName(),
                    'email' => $githubUser->getEmail(),
                    'provider' => 'github',
                    'password' => Hash::make(''),
                    'role_id' => RoleName::getId(RoleName::CUSTOMER),
                ]
            );
        }

        dd($user->token);
    }
//    public function github()
//    {
//        $url = Socialite::driver('github')->stateless()->redirect()->getTargetUrl();
//
//        return response()->json([
//            'url' => $url
//        ]);
//    }
//
//    public function githubRedirect()
//    {
//        $githubUser = Socialite::driver('github')->stateless()->user();
//
//        $user = User::firstOrCreate(
//            ['provider_id' => $githubUser->getId()],
//            [
//                'first_name' => $githubUser->getName(),
//                'email' => $githubUser->getEmail(),
//                'provider' => 'github',
//                'password' => Hash::make(''),
//                'role_id' => RoleName::getId(RoleName::CUSTOMER),
//            ]
//        );
//
//        Auth::login($user);
//        $token = $user->createToken('GitHub Token')->plainTextToken;
//        return response()->json([
//            'token' => $token,
//            'user' => $user,
//        ], 200);
//    }
}
