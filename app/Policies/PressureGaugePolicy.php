<?php

namespace App\Policies;

use App\Models\User;
use App\Models\PressureGauge;
use Illuminate\Auth\Access\HandlesAuthorization;

class PressureGaugePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the pressureGauge can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list pressuregauges');
    }

    /**
     * Determine whether the pressureGauge can view the model.
     */
    public function view(User $user, PressureGauge $model): bool
    {
        return $user->hasPermissionTo('view pressuregauges');
    }

    /**
     * Determine whether the pressureGauge can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create pressuregauges');
    }

    /**
     * Determine whether the pressureGauge can update the model.
     */
    public function update(User $user, PressureGauge $model): bool
    {
        return $user->hasPermissionTo('update pressuregauges');
    }

    /**
     * Determine whether the pressureGauge can delete the model.
     */
    public function delete(User $user, PressureGauge $model): bool
    {
        return $user->hasPermissionTo('delete pressuregauges');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete pressuregauges');
    }

    /**
     * Determine whether the pressureGauge can restore the model.
     */
    public function restore(User $user, PressureGauge $model): bool
    {
        return false;
    }

    /**
     * Determine whether the pressureGauge can permanently delete the model.
     */
    public function forceDelete(User $user, PressureGauge $model): bool
    {
        return false;
    }
}
