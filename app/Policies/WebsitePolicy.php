<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Website;
use Illuminate\Auth\Access\HandlesAuthorization;

class WebsitePolicy
{
    use HandlesAuthorization;

    public function updateWebsite(User $user, Website $website)
    {
        return $user->id === $website->user_id;
    }

    public function active(User $user, Website $website)
    {
        return $website->is_active;
    }
}
