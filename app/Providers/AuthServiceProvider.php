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
    // Definiciones de Gates para el perfil de Administrador
    Gate::define('administratorAccess', function (User $user) {
        return $user->profile_id == User::PROFILE_ADMINISTRATOR;
    });

    // Definiciones de Gates para el perfil de Profesor
    Gate::define('teacherAccess', function (User $user) {
        return $user->profile_id == User::PROFILE_TEACHER;
    });

    // Definiciones de Gates para el perfil de Estudiante
    Gate::define('studentAccess', function (User $user) {
        return $user->profile_id == User::PROFILE_STUDENT;
    });
}
}