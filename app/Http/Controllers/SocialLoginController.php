<?php

namespace App\Http\Controllers;

use Socialite;
use App\Repositories\User\UserInterface;
use Auth;

class SocialLoginController extends Controller
{
    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    public function redirectToProvider()
    {
        return Socialite::driver('github')->setScopes(['read:user'])->redirect();
    }

    public function handleProviderCallback()
    {
        $user = Socialite::driver('github')->stateless()->user();
        $user_info = $this->user->findByProviderID($user->id);

        if ($user_info) {
            Auth::loginUsingId($user_info->id, true);
            return redirect(route('home'));
        }
        $data = [
            'provider_id' => $user->id,
            'provider' => 'github',
            'name' => $user->name,
        ];
        $user_info = $this->user->create($data);
        Auth::loginUsingId($user_info->id, true);
        return redirect(route('home'));
    }
}
