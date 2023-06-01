<?php

namespace App\Policies;

use App\Models\User;
use App\Models\AllIndicationQuarter;
use Illuminate\Auth\Access\HandlesAuthorization;

class AllIndicationQuarterPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the allIndicationQuarter can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list allindicationquarters');
    }

    /**
     * Determine whether the allIndicationQuarter can view the model.
     */
    public function view(User $user, AllIndicationQuarter $model): bool
    {
        return $user->hasPermissionTo('view allindicationquarters');
    }

    /**
     * Determine whether the allIndicationQuarter can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create allindicationquarters');
    }

    /**
     * Determine whether the allIndicationQuarter can update the model.
     */
    public function update(User $user, AllIndicationQuarter $model): bool
    {
        return $user->hasPermissionTo('update allindicationquarters');
    }

    /**
     * Determine whether the allIndicationQuarter can delete the model.
     */
    public function delete(User $user, AllIndicationQuarter $model): bool
    {
        return $user->hasPermissionTo('delete allindicationquarters');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete allindicationquarters');
    }

    /**
     * Determine whether the allIndicationQuarter can restore the model.
     */
    public function restore(User $user, AllIndicationQuarter $model): bool
    {
        return false;
    }

    /**
     * Determine whether the allIndicationQuarter can permanently delete the model.
     */
    public function forceDelete(User $user, AllIndicationQuarter $model): bool
    {
        return false;
    }
}
