<?php

namespace App\Policies;

use App\Models\User;
use App\Models\PayTotal;
use Illuminate\Auth\Access\HandlesAuthorization;

class PayTotalPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the payTotal can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list paytotals');
    }

    /**
     * Determine whether the payTotal can view the model.
     */
    public function view(User $user, PayTotal $model): bool
    {
        return $user->hasPermissionTo('view paytotals');
    }

    /**
     * Determine whether the payTotal can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create paytotals');
    }

    /**
     * Determine whether the payTotal can update the model.
     */
    public function update(User $user, PayTotal $model): bool
    {
        return $user->hasPermissionTo('update paytotals');
    }

    /**
     * Determine whether the payTotal can delete the model.
     */
    public function delete(User $user, PayTotal $model): bool
    {
        return $user->hasPermissionTo('delete paytotals');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete paytotals');
    }

    /**
     * Determine whether the payTotal can restore the model.
     */
    public function restore(User $user, PayTotal $model): bool
    {
        return false;
    }

    /**
     * Determine whether the payTotal can permanently delete the model.
     */
    public function forceDelete(User $user, PayTotal $model): bool
    {
        return false;
    }
}
