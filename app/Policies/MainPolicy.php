<?php

namespace App\Policies;

use App\User;
use App\Specifics;
use Illuminate\Auth\Access\HandlesAuthorization;

class MainPolicy
{
    use HandlesAuthorization;

    public function action(User $user)
    {
        return $user->admin == true;
    }
}
