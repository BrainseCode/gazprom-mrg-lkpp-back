<?php

namespace App\Policies;

use App\Models\User;
use App\Models\PowerUnit;
use Illuminate\Auth\Access\HandlesAuthorization;

class PowerUnitPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the powerUnit can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list powerunits');
    }

    /**
     * Determine whether the powerUnit can view the model.
     */
    public function view(User $user, PowerUnit $model): bool
    {
        return $user->hasPermissionTo('view powerunits');
    }

    /**
     * Determine whether the powerUnit can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create powerunits');
    }

    /**
     * Determine whether the powerUnit can update the model.
     */
    public function update(User $user, PowerUnit $model): bool
    {
        return $user->hasPermissionTo('update powerunits');
    }

    /**
     * Determine whether the powerUnit can delete the model.
     */
    public function delete(User $user, PowerUnit $model): bool
    {
        return $user->hasPermissionTo('delete powerunits');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete powerunits');
    }

    /**
     * Determine whether the powerUnit can restore the model.
     */
    public function restore(User $user, PowerUnit $model): bool
    {
        return false;
    }

    /**
     * Determine whether the powerUnit can permanently delete the model.
     */
    public function forceDelete(User $user, PowerUnit $model): bool
    {
        return false;
    }
}
