<?php

namespace App\Policies;

use App\User;
use App\Models\PrepaidBalance;
use Illuminate\Auth\Access\HandlesAuthorization;

class PrepaidBalancePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the prepaidBalance.
     *
     * @param  \App\User  $user
     * @param  \App\Models\PrepaidBalance  $prepaidBalance
     * @return mixed
     */
    public function view(User $user, PrepaidBalance $prepaidBalance)
    {
        return $user->id === $prepaidBalance->order->user_id;
    }
}
