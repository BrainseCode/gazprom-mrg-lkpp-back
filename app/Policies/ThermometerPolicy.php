<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Thermometer;
use Illuminate\Auth\Access\HandlesAuthorization;

class ThermometerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the thermometer can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list thermometers');
    }

    /**
     * Determine whether the thermometer can view the model.
     */
    public function view(User $user, Thermometer $model): bool
    {
        return $user->hasPermissionTo('view thermometers');
    }

    /**
     * Determine whether the thermometer can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create thermometers');
    }

    /**
     * Determine whether the thermometer can update the model.
     */
    public function update(User $user, Thermometer $model): bool
    {
        return $user->hasPermissionTo('update thermometers');
    }

    /**
     * Determine whether the thermometer can delete the model.
     */
    public function delete(User $user, Thermometer $model): bool
    {
        return $user->hasPermissionTo('delete thermometers');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete thermometers');
    }

    /**
     * Determine whether the thermometer can restore the model.
     */
    public function restore(User $user, Thermometer $model): bool
    {
        return false;
    }

    /**
     * Determine whether the thermometer can permanently delete the model.
     */
    public function forceDelete(User $user, Thermometer $model): bool
    {
        return false;
    }
}
