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
        //Admin//
        Gate::define('seeReports', fn(User $user) => 
            $user->profile_id == User::PROFILE_ADMINISTRATOR
        );
        
        //Teacher//

        Gate::define('showCoursesByTeacher', fn(User $user) =>
            $user->profile_id == User::PROFILE_TEACHER
            
        );

/*         Gate::define('showCoursesByTeacher', fn(User $user) =>
        $user->profile_id == User::PROFILE_ADMINISTRATOR
        
    ); */

        Gate::define('showUsersInSubject', fn(User $user) =>
            $user->profile_id == User::PROFILE_TEACHER
        );

        Gate::define('showSubjectsInCourse', fn(User $user) =>
            $user->profile_id == User::PROFILE_TEACHER
        );

        //Student//
        Gate::define('showSubjectsByStudent', fn(User $user) =>
            $user->profile_id == User::PROFILE_STUDENT
        );

    }
}
