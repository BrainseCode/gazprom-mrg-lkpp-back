<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ConnectionPoint;
use Illuminate\Auth\Access\HandlesAuthorization;

class ConnectionPointPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the connectionPoint can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list connectionpoints');
    }

    /**
     * Determine whether the connectionPoint can view the model.
     */
    public function view(User $user, ConnectionPoint $model): bool
    {
        return $user->hasPermissionTo('view connectionpoints');
    }

    /**
     * Determine whether the connectionPoint can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create connectionpoints');
    }

    /**
     * Determine whether the connectionPoint can update the model.
     */
    public function update(User $user, ConnectionPoint $model): bool
    {
        return $user->hasPermissionTo('update connectionpoints');
    }

    /**
     * Determine whether the connectionPoint can delete the model.
     */
    public function delete(User $user, ConnectionPoint $model): bool
    {
        return $user->hasPermissionTo('delete connectionpoints');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete connectionpoints');
    }

    /**
     * Determine whether the connectionPoint can restore the model.
     */
    public function restore(User $user, ConnectionPoint $model): bool
    {
        return false;
    }

    /**
     * Determine whether the connectionPoint can permanently delete the model.
     */
    public function forceDelete(User $user, ConnectionPoint $model): bool
    {
        return false;
    }
}
