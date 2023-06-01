<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ContractStatus;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContractStatusPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the contractStatus can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list contractstatuses');
    }

    /**
     * Determine whether the contractStatus can view the model.
     */
    public function view(User $user, ContractStatus $model): bool
    {
        return $user->hasPermissionTo('view contractstatuses');
    }

    /**
     * Determine whether the contractStatus can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create contractstatuses');
    }

    /**
     * Determine whether the contractStatus can update the model.
     */
    public function update(User $user, ContractStatus $model): bool
    {
        return $user->hasPermissionTo('update contractstatuses');
    }

    /**
     * Determine whether the contractStatus can delete the model.
     */
    public function delete(User $user, ContractStatus $model): bool
    {
        return $user->hasPermissionTo('delete contractstatuses');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete contractstatuses');
    }

    /**
     * Determine whether the contractStatus can restore the model.
     */
    public function restore(User $user, ContractStatus $model): bool
    {
        return false;
    }

    /**
     * Determine whether the contractStatus can permanently delete the model.
     */
    public function forceDelete(User $user, ContractStatus $model): bool
    {
        return false;
    }
}
