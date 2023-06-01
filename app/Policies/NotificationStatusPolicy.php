<?php

namespace App\Policies;

use App\Models\User;
use App\Models\NotificationStatus;
use Illuminate\Auth\Access\HandlesAuthorization;

class NotificationStatusPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the notificationStatus can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list notificationstatuses');
    }

    /**
     * Determine whether the notificationStatus can view the model.
     */
    public function view(User $user, NotificationStatus $model): bool
    {
        return $user->hasPermissionTo('view notificationstatuses');
    }

    /**
     * Determine whether the notificationStatus can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create notificationstatuses');
    }

    /**
     * Determine whether the notificationStatus can update the model.
     */
    public function update(User $user, NotificationStatus $model): bool
    {
        return $user->hasPermissionTo('update notificationstatuses');
    }

    /**
     * Determine whether the notificationStatus can delete the model.
     */
    public function delete(User $user, NotificationStatus $model): bool
    {
        return $user->hasPermissionTo('delete notificationstatuses');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete notificationstatuses');
    }

    /**
     * Determine whether the notificationStatus can restore the model.
     */
    public function restore(User $user, NotificationStatus $model): bool
    {
        return false;
    }

    /**
     * Determine whether the notificationStatus can permanently delete the model.
     */
    public function forceDelete(User $user, NotificationStatus $model): bool
    {
        return false;
    }
}
