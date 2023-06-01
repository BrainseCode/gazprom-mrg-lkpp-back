<?php

namespace App\Policies;

use App\Models\User;
use App\Models\IndicationQuarter;
use Illuminate\Auth\Access\HandlesAuthorization;

class IndicationQuarterPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the indicationQuarter can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list indicationquarters');
    }

    /**
     * Determine whether the indicationQuarter can view the model.
     */
    public function view(User $user, IndicationQuarter $model): bool
    {
        return $user->hasPermissionTo('view indicationquarters');
    }

    /**
     * Determine whether the indicationQuarter can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create indicationquarters');
    }

    /**
     * Determine whether the indicationQuarter can update the model.
     */
    public function update(User $user, IndicationQuarter $model): bool
    {
        return $user->hasPermissionTo('update indicationquarters');
    }

    /**
     * Determine whether the indicationQuarter can delete the model.
     */
    public function delete(User $user, IndicationQuarter $model): bool
    {
        return $user->hasPermissionTo('delete indicationquarters');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete indicationquarters');
    }

    /**
     * Determine whether the indicationQuarter can restore the model.
     */
    public function restore(User $user, IndicationQuarter $model): bool
    {
        return false;
    }

    /**
     * Determine whether the indicationQuarter can permanently delete the model.
     */
    public function forceDelete(User $user, IndicationQuarter $model): bool
    {
        return false;
    }
}
