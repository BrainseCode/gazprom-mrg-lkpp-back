<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Meter;
use Illuminate\Auth\Access\HandlesAuthorization;

class MeterPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the meter can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list meters');
    }

    /**
     * Determine whether the meter can view the model.
     */
    public function view(User $user, Meter $model): bool
    {
        return $user->hasPermissionTo('view meters');
    }

    /**
     * Determine whether the meter can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create meters');
    }

    /**
     * Determine whether the meter can update the model.
     */
    public function update(User $user, Meter $model): bool
    {
        return $user->hasPermissionTo('update meters');
    }

    /**
     * Determine whether the meter can delete the model.
     */
    public function delete(User $user, Meter $model): bool
    {
        return $user->hasPermissionTo('delete meters');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete meters');
    }

    /**
     * Determine whether the meter can restore the model.
     */
    public function restore(User $user, Meter $model): bool
    {
        return false;
    }

    /**
     * Determine whether the meter can permanently delete the model.
     */
    public function forceDelete(User $user, Meter $model): bool
    {
        return false;
    }
}
