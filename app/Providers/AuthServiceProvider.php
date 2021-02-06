<?php

namespace App\Providers;

use App\Models\TaskStatus;
use App\Models\User;
use App\Policies\TaskStatusPolicy;
use Illuminate\Auth\Access\Response;
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
        TaskStatus::class => TaskStatusPolicy::class
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

        Gate::define('destroy-task-status', function (User $user, TaskStatus $taskStatus) {
            return (bool)$user && $taskStatus->tasks->count() == 0
                ? Response::allow()
                : Response::deny(__('flash.task-status.destroy.error'));
        });
    }
}
