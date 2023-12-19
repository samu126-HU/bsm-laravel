<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Admin;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
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

        Gate::define('loggedIn', function ($user) {
            if ($user) {
                return true;
            }
        });
        
        Gate::define('inCart', function ($user, $post) {
            if ($user) {
                return Cart::where('id', $post)->where('user_id', $user->id)->exists();
            }
        });

        Gate::define('isAdmin', function ($user) {
            $id = $user->id;
            if (Admin::where('user_id', $id)->exists()) {
                return true;
            };
        });
    }
}
