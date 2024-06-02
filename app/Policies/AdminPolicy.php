<?php

namespace App\Policies;

use App\Models\User;

class AdminPolicy
{
    public function view(User $user)
    {
        return $user->role->name === 'admin';
    }
}
