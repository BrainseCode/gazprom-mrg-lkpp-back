<?php

namespace App\Policies;

use App\Models\User;
use App\Models\PayGasDelivered;
use Illuminate\Auth\Access\HandlesAuthorization;

class PayGasDeliveredPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the payGasDelivered can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list paygasdelivereds');
    }

    /**
     * Determine whether the payGasDelivered can view the model.
     */
    public function view(User $user, PayGasDelivered $model): bool
    {
        return $user->hasPermissionTo('view paygasdelivereds');
    }

    /**
     * Determine whether the payGasDelivered can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create paygasdelivereds');
    }

    /**
     * Determine whether the payGasDelivered can update the model.
     */
    public function update(User $user, PayGasDelivered $model): bool
    {
        return $user->hasPermissionTo('update paygasdelivereds');
    }

    /**
     * Determine whether the payGasDelivered can delete the model.
     */
    public function delete(User $user, PayGasDelivered $model): bool
    {
        return $user->hasPermissionTo('delete paygasdelivereds');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete paygasdelivereds');
    }

    /**
     * Determine whether the payGasDelivered can restore the model.
     */
    public function restore(User $user, PayGasDelivered $model): bool
    {
        return false;
    }

    /**
     * Determine whether the payGasDelivered can permanently delete the model.
     */
    public function forceDelete(User $user, PayGasDelivered $model): bool
    {
        return false;
    }
}
