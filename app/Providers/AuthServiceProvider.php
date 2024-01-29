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
        Gate::define('seeReports', fn(User $user) => 
            $user->profile_id == User::PROFILE_ADMINISTRATOR
        );

        Gate::define('showCourses', fn(User $user) =>
            $user->profile_id == User::PROFILE_TEACHER
        );

        Gate::define('mySubjects', fn(User $user) =>
            $user->profile_id == User::PROFILE_STUDENT
        );

    }
}
