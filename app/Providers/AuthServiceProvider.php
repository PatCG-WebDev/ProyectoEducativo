<?php

namespace App\Providers;

use App\Models\User; 
use Illuminate\Support\Facades\Gate;
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
        //
        Gate::define('see-reports', fn(User $user) => 
            $user->profile_id == User::PROFILE_ADMINISTRATOR
        );

        Gate::define('ad-grades', fn(User $user) =>
            $user->profile_id == User::PROFILE_TEACHER
        );

        Gate::define('my-subjects', fn(User $user) =>
            $user->profile_id == User::PROFILE_STUDENT
        );

    }
}
