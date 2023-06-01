<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserProfilePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the userProfile can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list userprofiles');
    }

    /**
     * Determine whether the userProfile can view the model.
     */
    public function view(User $user, UserProfile $model): bool
    {
        return $user->hasPermissionTo('view userprofiles');
    }

    /**
     * Determine whether the userProfile can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create userprofiles');
    }

    /**
     * Determine whether the userProfile can update the model.
     */
    public function update(User $user, UserProfile $model): bool
    {
        return $user->hasPermissionTo('update userprofiles');
    }

    /**
     * Determine whether the userProfile can delete the model.
     */
    public function delete(User $user, UserProfile $model): bool
    {
        return $user->hasPermissionTo('delete userprofiles');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete userprofiles');
    }

    /**
     * Determine whether the userProfile can restore the model.
     */
    public function restore(User $user, UserProfile $model): bool
    {
        return false;
    }

    /**
     * Determine whether the userProfile can permanently delete the model.
     */
    public function forceDelete(User $user, UserProfile $model): bool
    {
        return false;
    }
}
