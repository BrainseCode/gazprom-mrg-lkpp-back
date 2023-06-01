<?php

namespace App\Policies;

use App\Models\User;
use App\Models\IndicationSource;
use Illuminate\Auth\Access\HandlesAuthorization;

class IndicationSourcePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the indicationSource can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list indicationsources');
    }

    /**
     * Determine whether the indicationSource can view the model.
     */
    public function view(User $user, IndicationSource $model): bool
    {
        return $user->hasPermissionTo('view indicationsources');
    }

    /**
     * Determine whether the indicationSource can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create indicationsources');
    }

    /**
     * Determine whether the indicationSource can update the model.
     */
    public function update(User $user, IndicationSource $model): bool
    {
        return $user->hasPermissionTo('update indicationsources');
    }

    /**
     * Determine whether the indicationSource can delete the model.
     */
    public function delete(User $user, IndicationSource $model): bool
    {
        return $user->hasPermissionTo('delete indicationsources');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete indicationsources');
    }

    /**
     * Determine whether the indicationSource can restore the model.
     */
    public function restore(User $user, IndicationSource $model): bool
    {
        return false;
    }

    /**
     * Determine whether the indicationSource can permanently delete the model.
     */
    public function forceDelete(User $user, IndicationSource $model): bool
    {
        return false;
    }
}
