<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UniversalRequest;
use Illuminate\Auth\Access\HandlesAuthorization;

class UniversalRequestPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the universalRequest can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list universalrequests');
    }

    /**
     * Determine whether the universalRequest can view the model.
     */
    public function view(User $user, UniversalRequest $model): bool
    {
        return $user->hasPermissionTo('view universalrequests');
    }

    /**
     * Determine whether the universalRequest can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create universalrequests');
    }

    /**
     * Determine whether the universalRequest can update the model.
     */
    public function update(User $user, UniversalRequest $model): bool
    {
        return $user->hasPermissionTo('update universalrequests');
    }

    /**
     * Determine whether the universalRequest can delete the model.
     */
    public function delete(User $user, UniversalRequest $model): bool
    {
        return $user->hasPermissionTo('delete universalrequests');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete universalrequests');
    }

    /**
     * Determine whether the universalRequest can restore the model.
     */
    public function restore(User $user, UniversalRequest $model): bool
    {
        return false;
    }

    /**
     * Determine whether the universalRequest can permanently delete the model.
     */
    public function forceDelete(User $user, UniversalRequest $model): bool
    {
        return false;
    }
}
