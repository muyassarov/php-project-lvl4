<?php

namespace App\Policies;

use App\Models\{Task, User};
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  ?User  $user
     * @return mixed
     */
    public function viewAny(?User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  ?User  $user
     * @param  Task  $task
     * @return mixed
     */
    public function view(?User $user, Task $task): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  User  $user
     * @return mixed
     */
    public function create(User $user): bool
    {
        return (bool)$user;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  User  $user
     * @param  Task  $task
     * @return mixed
     */
    public function update(User $user, Task $task): bool
    {
        return (bool)$user;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Task  $task
     * @return mixed
     */
    public function delete(User $user, Task $task): bool
    {
        return $task->creator->is($user);
    }
}
