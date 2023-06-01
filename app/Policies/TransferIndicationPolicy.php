<?php

namespace App\Policies;

use App\Models\User;
use App\Models\TransferIndication;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransferIndicationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the transferIndication can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list transferindications');
    }

    /**
     * Determine whether the transferIndication can view the model.
     */
    public function view(User $user, TransferIndication $model): bool
    {
        return $user->hasPermissionTo('view transferindications');
    }

    /**
     * Determine whether the transferIndication can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create transferindications');
    }

    /**
     * Determine whether the transferIndication can update the model.
     */
    public function update(User $user, TransferIndication $model): bool
    {
        return $user->hasPermissionTo('update transferindications');
    }

    /**
     * Determine whether the transferIndication can delete the model.
     */
    public function delete(User $user, TransferIndication $model): bool
    {
        return $user->hasPermissionTo('delete transferindications');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete transferindications');
    }

    /**
     * Determine whether the transferIndication can restore the model.
     */
    public function restore(User $user, TransferIndication $model): bool
    {
        return false;
    }

    /**
     * Determine whether the transferIndication can permanently delete the model.
     */
    public function forceDelete(User $user, TransferIndication $model): bool
    {
        return false;
    }
}
