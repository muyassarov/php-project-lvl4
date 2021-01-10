<?php

namespace App\Policies;

use App\Models\{Label, User};
use Illuminate\Auth\Access\HandlesAuthorization;

class LabelPolicy
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
     * @param  Label  $label
     * @return mixed
     */
    public function view(?User $user, Label $label): bool
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
     * @param  Label  $label
     * @return mixed
     */
    public function update(User $user, Label $label): bool
    {
        return (bool)$user;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  User  $user
     * @param  Label  $label
     * @return mixed
     */
    public function delete(User $user, Label $label): bool
    {
        return (bool)$user;
    }
}
