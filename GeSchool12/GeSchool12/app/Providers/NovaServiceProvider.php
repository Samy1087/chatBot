<?php

namespace App\Providers;

use App\Nova\Role;
use App\Models\User;
use Laravel\Nova\Nova;
use App\Nova\Permission;
use App\Nova\Etudiant; // Assure-toi que c'est bien ici

use Laravel\Fortify\Features;
use Laravel\Nova\Menu\MenuSection;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\NovaApplicationServiceProvider;


class NovaServiceProvider extends NovaApplicationServiceProvider
{

    protected function resources()
    {
        Nova::resources([
            \App\Nova\User::class, // Ajoute la ressource User ici
            Role::class, // Utilise le bon nom ici
            Permission::class,
            \App\Nova\Classe::class,  // Ajoute ici ta ressource Classe
             Etudiant::class, // Ajoute ici ta ressource Etudiant
            \App\Nova\Note::class, 
            \App\Nova\Matiere::class, 
            \App\Nova\ParentModel::class, 
            \App\Nova\Enseignant::class, 
            \App\Nova\Paiement::class, 
          
            \App\Nova\EmploiDuTemps::class,
            ]);
        
    
       

 

   
}
    

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        parent::boot();

        //
    }

    /**
     * Register the configurations for Laravel Fortify.
     */
    protected function fortify(): void
    {
        Nova::fortify()
            ->features([
                Features::updatePasswords(),
                // Features::emailVerification(),
                // Features::twoFactorAuthentication(['confirm' => true, 'confirmPassword' => true]),
            ])
            ->register();
    }

    /**
     * Register the Nova routes.
     */
    protected function routes(): void
    {
        Nova::routes()
            ->withAuthenticationRoutes(default: true)
            ->withPasswordResetRoutes()
            ->withoutEmailVerificationRoutes()
            ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     */
    protected function gate(): void
    {
        Gate::define('viewNova', function (User $user) {
            return in_array($user->email, [
                //
            ]);
        });
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array<int, \Laravel\Nova\Dashboard>
     */
    protected function dashboards(): array
    {
        return [
            new \App\Nova\Dashboards\Main,
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array<int, \Laravel\Nova\Tool>
     */
    public function tools(): array
    {
        return [];
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        parent::register();

        //
    }
}
