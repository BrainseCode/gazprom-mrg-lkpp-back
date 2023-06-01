<?php

namespace App\Policies;

use App\Models\User;
use App\Models\RequestApprovalUnevenness;
use Illuminate\Auth\Access\HandlesAuthorization;

class RequestApprovalUnevennessPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the requestApprovalUnevenness can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list requestapprovalunevennesses');
    }

    /**
     * Determine whether the requestApprovalUnevenness can view the model.
     */
    public function view(User $user, RequestApprovalUnevenness $model): bool
    {
        return $user->hasPermissionTo('view requestapprovalunevennesses');
    }

    /**
     * Determine whether the requestApprovalUnevenness can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create requestapprovalunevennesses');
    }

    /**
     * Determine whether the requestApprovalUnevenness can update the model.
     */
    public function update(User $user, RequestApprovalUnevenness $model): bool
    {
        return $user->hasPermissionTo('update requestapprovalunevennesses');
    }

    /**
     * Determine whether the requestApprovalUnevenness can delete the model.
     */
    public function delete(User $user, RequestApprovalUnevenness $model): bool
    {
        return $user->hasPermissionTo('delete requestapprovalunevennesses');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete requestapprovalunevennesses');
    }

    /**
     * Determine whether the requestApprovalUnevenness can restore the model.
     */
    public function restore(User $user, RequestApprovalUnevenness $model): bool
    {
        return false;
    }

    /**
     * Determine whether the requestApprovalUnevenness can permanently delete the model.
     */
    public function forceDelete(
        User $user,
        RequestApprovalUnevenness $model
    ): bool {
        return false;
    }
}
