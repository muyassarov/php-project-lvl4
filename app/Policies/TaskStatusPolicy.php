<?php

namespace App\Policies;

use App\Models\{TaskStatus, User};
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskStatusPolicy
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
     * @param  TaskStatus  $taskStatus
     * @return mixed
     */
    public function view(?User $user, TaskStatus $taskStatus): bool
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
     * @param  TaskStatus  $taskStatus
     * @return mixed
     */
    public function update(User $user, TaskStatus $taskStatus): bool
    {
        return (bool)$user;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  User  $user
     * @param  TaskStatus  $taskStatus
     * @return mixed
     */
    public function delete(User $user, TaskStatus $taskStatus)
    {
        return (bool)$user;
    }
}
