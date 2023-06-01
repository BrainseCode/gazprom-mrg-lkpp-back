<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ContractType;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContractTypePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the contractType can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list contracttypes');
    }

    /**
     * Determine whether the contractType can view the model.
     */
    public function view(User $user, ContractType $model): bool
    {
        return $user->hasPermissionTo('view contracttypes');
    }

    /**
     * Determine whether the contractType can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create contracttypes');
    }

    /**
     * Determine whether the contractType can update the model.
     */
    public function update(User $user, ContractType $model): bool
    {
        return $user->hasPermissionTo('update contracttypes');
    }

    /**
     * Determine whether the contractType can delete the model.
     */
    public function delete(User $user, ContractType $model): bool
    {
        return $user->hasPermissionTo('delete contracttypes');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete contracttypes');
    }

    /**
     * Determine whether the contractType can restore the model.
     */
    public function restore(User $user, ContractType $model): bool
    {
        return false;
    }

    /**
     * Determine whether the contractType can permanently delete the model.
     */
    public function forceDelete(User $user, ContractType $model): bool
    {
        return false;
    }
}
