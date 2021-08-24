<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;

class SocialController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callbackProvider($provider)
    {
        $user = Socialite::driver($provider)->user();

        Auth::login($this->findOrCreateFunction($user, $provider));
        return redirect()->intended();
    }

    protected function findOrCreateFunction($user, $driver)
    {
        $providerUser = User::where([
            'email' => $user->getEmail()
        ])->first();

        if (!is_null($providerUser)) return $providerUser;

        return User::create([
            'email' => $user->getEmail(),
            'name' => $user->getName(),
            'provider' => $driver,
            'provider_id' => $user->getId(),
            'avatar' => $user->getAvatar(),
            'email_verified_at' => now()
        ]);
    }
}
