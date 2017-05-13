<?php

namespace App\Policies;

use App\User;
use App\Models\ProductCommerce;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductCommercePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the ProductCommerce.
     *
     * @param  \App\User  $user
     * @param  \App\Models\ProductCommerce  $productCommerce
     * @return mixed
     */
    public function view(User $user, ProductCommerce $productCommerce)
    {
        return $user->id === $productCommerce->order->user_id;
    }
}
