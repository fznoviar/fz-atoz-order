<?php

namespace App\Providers;

use App\Models\PrepaidBalance;
use App\Models\ProductCommerce;
use App\Policies\PrepaidBalancePolicy;
use App\Policies\ProductCommercePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        PrepaidBalance::class => PrepaidBalancePolicy::class,
        ProductCommerce::class => ProductCommercePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
