<?php

namespace App\Policies;

use App\Models\User;
use App\Models\IndicationStatus;
use Illuminate\Auth\Access\HandlesAuthorization;

class IndicationStatusPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the indicationStatus can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list indicationstatuses');
    }

    /**
     * Determine whether the indicationStatus can view the model.
     */
    public function view(User $user, IndicationStatus $model): bool
    {
        return $user->hasPermissionTo('view indicationstatuses');
    }

    /**
     * Determine whether the indicationStatus can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create indicationstatuses');
    }

    /**
     * Determine whether the indicationStatus can update the model.
     */
    public function update(User $user, IndicationStatus $model): bool
    {
        return $user->hasPermissionTo('update indicationstatuses');
    }

    /**
     * Determine whether the indicationStatus can delete the model.
     */
    public function delete(User $user, IndicationStatus $model): bool
    {
        return $user->hasPermissionTo('delete indicationstatuses');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete indicationstatuses');
    }

    /**
     * Determine whether the indicationStatus can restore the model.
     */
    public function restore(User $user, IndicationStatus $model): bool
    {
        return false;
    }

    /**
     * Determine whether the indicationStatus can permanently delete the model.
     */
    public function forceDelete(User $user, IndicationStatus $model): bool
    {
        return false;
    }
}
