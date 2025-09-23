<?php

namespace App\Providers;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

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
        Gate::define('is-admin', function (User $user) {
        return (bool) $user->is_admin === true; //في جدول اليوزر يكون بترو عشان الجيت كمان ترجع ترو is_admin هنا بقول لازم عمود 
        });
        Gate::define('is-user', function (User $user) {
            return (bool) $user->is_user === true;
        });
        Gate::define('is-doctor', function (User $user) {
            return (bool) $user->is_doctor === true;
        });
    }
}
