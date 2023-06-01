<?php

namespace App\Policies;

use App\Models\User;
use App\Models\MeasuringComplex;
use Illuminate\Auth\Access\HandlesAuthorization;

class MeasuringComplexPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the measuringComplex can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list measuringcomplexes');
    }

    /**
     * Determine whether the measuringComplex can view the model.
     */
    public function view(User $user, MeasuringComplex $model): bool
    {
        return $user->hasPermissionTo('view measuringcomplexes');
    }

    /**
     * Determine whether the measuringComplex can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create measuringcomplexes');
    }

    /**
     * Determine whether the measuringComplex can update the model.
     */
    public function update(User $user, MeasuringComplex $model): bool
    {
        return $user->hasPermissionTo('update measuringcomplexes');
    }

    /**
     * Determine whether the measuringComplex can delete the model.
     */
    public function delete(User $user, MeasuringComplex $model): bool
    {
        return $user->hasPermissionTo('delete measuringcomplexes');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete measuringcomplexes');
    }

    /**
     * Determine whether the measuringComplex can restore the model.
     */
    public function restore(User $user, MeasuringComplex $model): bool
    {
        return false;
    }

    /**
     * Determine whether the measuringComplex can permanently delete the model.
     */
    public function forceDelete(User $user, MeasuringComplex $model): bool
    {
        return false;
    }
}
