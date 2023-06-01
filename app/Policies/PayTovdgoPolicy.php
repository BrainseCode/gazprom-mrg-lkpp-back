<?php

namespace App\Policies;

use App\Models\User;
use App\Models\PayTovdgo;
use Illuminate\Auth\Access\HandlesAuthorization;

class PayTovdgoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the payTovdgo can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list paytovdgos');
    }

    /**
     * Determine whether the payTovdgo can view the model.
     */
    public function view(User $user, PayTovdgo $model): bool
    {
        return $user->hasPermissionTo('view paytovdgos');
    }

    /**
     * Determine whether the payTovdgo can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create paytovdgos');
    }

    /**
     * Determine whether the payTovdgo can update the model.
     */
    public function update(User $user, PayTovdgo $model): bool
    {
        return $user->hasPermissionTo('update paytovdgos');
    }

    /**
     * Determine whether the payTovdgo can delete the model.
     */
    public function delete(User $user, PayTovdgo $model): bool
    {
        return $user->hasPermissionTo('delete paytovdgos');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete paytovdgos');
    }

    /**
     * Determine whether the payTovdgo can restore the model.
     */
    public function restore(User $user, PayTovdgo $model): bool
    {
        return false;
    }

    /**
     * Determine whether the payTovdgo can permanently delete the model.
     */
    public function forceDelete(User $user, PayTovdgo $model): bool
    {
        return false;
    }
}
