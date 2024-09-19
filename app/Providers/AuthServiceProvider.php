<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Offer;
use App\Policies\OfferPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Offer::class => OfferPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
