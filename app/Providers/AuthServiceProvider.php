<?php

namespace App\Providers;

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
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('user-pessoa', function($user){
            return $user->Usu_TipoPessoa === 'F'; // F para Pessoa Fisica
        });

        Gate::define('user-lojista', function($user){
            return $user->Usu_TipoPessoa === 'J'; // F para Pessoa Juridica/Lojista
        });

    }
}
