<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Indication;
use Illuminate\Auth\Access\HandlesAuthorization;

class IndicationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the indication can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list indications');
    }

    /**
     * Determine whether the indication can view the model.
     */
    public function view(User $user, Indication $model): bool
    {
        return $user->hasPermissionTo('view indications');
    }

    /**
     * Determine whether the indication can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create indications');
    }

    /**
     * Determine whether the indication can update the model.
     */
    public function update(User $user, Indication $model): bool
    {
        return $user->hasPermissionTo('update indications');
    }

    /**
     * Determine whether the indication can delete the model.
     */
    public function delete(User $user, Indication $model): bool
    {
        return $user->hasPermissionTo('delete indications');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete indications');
    }

    /**
     * Determine whether the indication can restore the model.
     */
    public function restore(User $user, Indication $model): bool
    {
        return false;
    }

    /**
     * Determine whether the indication can permanently delete the model.
     */
    public function forceDelete(User $user, Indication $model): bool
    {
        return false;
    }
}
