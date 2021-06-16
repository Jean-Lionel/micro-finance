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

        //

         Gate::define('edit-user', function ($user) {

           return $user->isAdmin();
        });

         // Gate::define('destroy-user', function($user){
         //     return $user->isRetraitUser();

         // });

         Gate::define('is-admin',function($user){
            return $user->isAdmin();
        });

         Gate::define('is-retrait-user', function($user){
            return $user->isRetraitUser();
         });

         Gate::define('is-versement-user', function($user){
            return $user->isVersementUser();
         });

         Gate::define('is-register-client', function($user){
            return $user->isRegisterClient();
         });


         Gate::define('manager-user', function($user){
            return $user->hasAnyRoles(['ADMIN']);

         });


         Gate::define('placement-manager', function($user){
            return $user->isRetraitInteretPlacement();
         });

         Gate::define('decouvert-manager', function($user){

            return $user->isDecouvert();

         });

         Gate::define('is-placement', function($user){

            return $user->isPlacement();

         });
    }
}
