<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate; // Corrigir a importação do facade

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies(); // Chamar o método parent::boot() para registrar as políticas padrão

        Gate::define('level', function (User $user) {
            return $user->level === 'admin';
        });
    }
}
