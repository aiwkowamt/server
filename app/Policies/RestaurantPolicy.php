<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Restaurant;

class RestaurantPolicy
{
    public function view(User $user, Restaurant $restaurant)
    {
        return $user->id === $restaurant->user_id;
    }
}
