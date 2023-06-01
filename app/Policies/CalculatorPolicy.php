<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Calculator;
use Illuminate\Auth\Access\HandlesAuthorization;

class CalculatorPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the calculator can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list calculators');
    }

    /**
     * Determine whether the calculator can view the model.
     */
    public function view(User $user, Calculator $model): bool
    {
        return $user->hasPermissionTo('view calculators');
    }

    /**
     * Determine whether the calculator can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create calculators');
    }

    /**
     * Determine whether the calculator can update the model.
     */
    public function update(User $user, Calculator $model): bool
    {
        return $user->hasPermissionTo('update calculators');
    }

    /**
     * Determine whether the calculator can delete the model.
     */
    public function delete(User $user, Calculator $model): bool
    {
        return $user->hasPermissionTo('delete calculators');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete calculators');
    }

    /**
     * Determine whether the calculator can restore the model.
     */
    public function restore(User $user, Calculator $model): bool
    {
        return false;
    }

    /**
     * Determine whether the calculator can permanently delete the model.
     */
    public function forceDelete(User $user, Calculator $model): bool
    {
        return false;
    }
}
