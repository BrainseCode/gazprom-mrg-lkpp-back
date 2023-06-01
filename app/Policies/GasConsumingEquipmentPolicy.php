<?php

namespace App\Policies;

use App\Models\User;
use App\Models\GasConsumingEquipment;
use Illuminate\Auth\Access\HandlesAuthorization;

class GasConsumingEquipmentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the gasConsumingEquipment can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('list gasconsumingequipments');
    }

    /**
     * Determine whether the gasConsumingEquipment can view the model.
     */
    public function view(User $user, GasConsumingEquipment $model): bool
    {
        return $user->hasPermissionTo('view gasconsumingequipments');
    }

    /**
     * Determine whether the gasConsumingEquipment can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create gasconsumingequipments');
    }

    /**
     * Determine whether the gasConsumingEquipment can update the model.
     */
    public function update(User $user, GasConsumingEquipment $model): bool
    {
        return $user->hasPermissionTo('update gasconsumingequipments');
    }

    /**
     * Determine whether the gasConsumingEquipment can delete the model.
     */
    public function delete(User $user, GasConsumingEquipment $model): bool
    {
        return $user->hasPermissionTo('delete gasconsumingequipments');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermissionTo('delete gasconsumingequipments');
    }

    /**
     * Determine whether the gasConsumingEquipment can restore the model.
     */
    public function restore(User $user, GasConsumingEquipment $model): bool
    {
        return false;
    }

    /**
     * Determine whether the gasConsumingEquipment can permanently delete the model.
     */
    public function forceDelete(User $user, GasConsumingEquipment $model): bool
    {
        return false;
    }
}
