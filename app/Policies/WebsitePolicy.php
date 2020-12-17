<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Website;
use Illuminate\Auth\Access\HandlesAuthorization;

class WebsitePolicy
{
    use HandlesAuthorization;

    public function ownerOrAdmin(User $user, Website $website)
    {
        return $user->id === $website->user_id || auth()->user()->role === config('constants.ROLE.ADMIN');
    }

    public function owner(User $user, Website $website)
    {
        return $user->id === $website->user_id;
    }

    public function active(User $user, Website $website)
    {
        return $website->is_active;
    }
}
