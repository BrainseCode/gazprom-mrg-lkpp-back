<?php

namespace App\Policies;

use App\Models\User;
use App\Models\RequestCallEmployee;
use Illuminate\Auth\Access\HandlesAuthorization;

class RequestCallEmployeePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the requestCallEmployee can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list requestcallemployees');
    }

    /**
     * Determine whether the requestCallEmployee can view the model.
     */
    public function view(User $user, RequestCallEmployee $model): bool
    {
        return $user->hasPermissionTo('view requestcallemployees');
    }

    /**
     * Determine whether the requestCallEmployee can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create requestcallemployees');
    }

    /**
     * Determine whether the requestCallEmployee can update the model.
     */
    public function update(User $user, RequestCallEmployee $model): bool
    {
        return $user->hasPermissionTo('update requestcallemployees');
    }

    /**
     * Determine whether the requestCallEmployee can delete the model.
     */
    public function delete(User $user, RequestCallEmployee $model): bool
    {
        return $user->hasPermissionTo('delete requestcallemployees');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete requestcallemployees');
    }

    /**
     * Determine whether the requestCallEmployee can restore the model.
     */
    public function restore(User $user, RequestCallEmployee $model): bool
    {
        return false;
    }

    /**
     * Determine whether the requestCallEmployee can permanently delete the model.
     */
    public function forceDelete(User $user, RequestCallEmployee $model): bool
    {
        return false;
    }
}
