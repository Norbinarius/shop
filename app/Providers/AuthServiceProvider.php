<?php

namespace App\Providers;

use App\Companies;
use App\Devices;
use App\Policies\MainPolicy;
use App\Specifics;
use App\Types;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        Specifics::class => MainPolicy::class,
        Companies::class => MainPolicy::class,
        Devices::class => MainPolicy::class,
        Types::class => MainPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
