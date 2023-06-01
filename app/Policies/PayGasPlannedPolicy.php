<?php

namespace App\Policies;

use App\Models\User;
use App\Models\PayGasPlanned;
use Illuminate\Auth\Access\HandlesAuthorization;

class PayGasPlannedPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the payGasPlanned can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list paygasplanneds');
    }

    /**
     * Determine whether the payGasPlanned can view the model.
     */
    public function view(User $user, PayGasPlanned $model): bool
    {
        return $user->hasPermissionTo('view paygasplanneds');
    }

    /**
     * Determine whether the payGasPlanned can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create paygasplanneds');
    }

    /**
     * Determine whether the payGasPlanned can update the model.
     */
    public function update(User $user, PayGasPlanned $model): bool
    {
        return $user->hasPermissionTo('update paygasplanneds');
    }

    /**
     * Determine whether the payGasPlanned can delete the model.
     */
    public function delete(User $user, PayGasPlanned $model): bool
    {
        return $user->hasPermissionTo('delete paygasplanneds');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete paygasplanneds');
    }

    /**
     * Determine whether the payGasPlanned can restore the model.
     */
    public function restore(User $user, PayGasPlanned $model): bool
    {
        return false;
    }

    /**
     * Determine whether the payGasPlanned can permanently delete the model.
     */
    public function forceDelete(User $user, PayGasPlanned $model): bool
    {
        return false;
    }
}
