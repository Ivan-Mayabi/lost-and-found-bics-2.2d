<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\IdReplacement;
use App\Policies\IdReplacementPolicy;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    // protected $policies = [
    //     IdReplacement::class => IdReplacementPolicy::class,
    // ];
    
    public function boot(): void
    {
        //  $this->registerPolicies();
    }
   
}