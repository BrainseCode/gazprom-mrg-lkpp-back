<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UnallocatedByDate;
use Illuminate\Auth\Access\HandlesAuthorization;

class UnallocatedByDatePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the unallocatedByDate can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list unallocatedbydates');
    }

    /**
     * Determine whether the unallocatedByDate can view the model.
     */
    public function view(User $user, UnallocatedByDate $model): bool
    {
        return $user->hasPermissionTo('view unallocatedbydates');
    }

    /**
     * Determine whether the unallocatedByDate can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create unallocatedbydates');
    }

    /**
     * Determine whether the unallocatedByDate can update the model.
     */
    public function update(User $user, UnallocatedByDate $model): bool
    {
        return $user->hasPermissionTo('update unallocatedbydates');
    }

    /**
     * Determine whether the unallocatedByDate can delete the model.
     */
    public function delete(User $user, UnallocatedByDate $model): bool
    {
        return $user->hasPermissionTo('delete unallocatedbydates');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete unallocatedbydates');
    }

    /**
     * Determine whether the unallocatedByDate can restore the model.
     */
    public function restore(User $user, UnallocatedByDate $model): bool
    {
        return false;
    }

    /**
     * Determine whether the unallocatedByDate can permanently delete the model.
     */
    public function forceDelete(User $user, UnallocatedByDate $model): bool
    {
        return false;
    }
}
