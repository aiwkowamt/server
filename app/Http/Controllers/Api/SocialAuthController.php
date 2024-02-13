<?php

namespace App\Http\Controllers\Api;

use App\Enums\RoleName;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    public function redirectToProvider($provider)
    {
        $url = Socialite::driver($provider)->stateless()->redirect()->getTargetUrl();
        return response()->json([
            'url' => $url,
        ]);
    }

    public function handleProviderCallback($provider)
    {
        $socialiteUser = Socialite::driver($provider)->stateless()->user();

        $user = User::where('email', $socialiteUser->getEmail())->first();
        if (!$user) {
            $user = User::create([
                'provider_id' => $socialiteUser->getId(),
                'first_name' => $socialiteUser->getName(),
                'email' => $socialiteUser->getEmail(),
                'provider' => 'github',
                'password' => Hash::make(''),
                'role_id' => RoleName::getId(RoleName::CUSTOMER),
            ]);
        }
        $token = $user->createToken('token')->plainTextToken;
        return response()->json([
            'token' => $token,
            'user' => $user,
        ], 200);
    }
}
