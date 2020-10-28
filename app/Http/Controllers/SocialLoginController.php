<?php

namespace App\Http\Controllers;

use Socialite;

class SocialLoginController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('github')->setScopes(['read:user'])->redirect();
    }

    public function handleProviderCallback()
    {
        $user = Socialite::driver('github')->stateless()->user();
        dd($user->token);
        // $user->token;
    }
}
