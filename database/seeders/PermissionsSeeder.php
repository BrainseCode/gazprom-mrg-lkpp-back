<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create default permissions
        Permission::create(['name' => 'list allindicationquarters']);
        Permission::create(['name' => 'view allindicationquarters']);
        Permission::create(['name' => 'create allindicationquarters']);
        Permission::create(['name' => 'update allindicationquarters']);
        Permission::create(['name' => 'delete allindicationquarters']);

        Permission::create(['name' => 'list calculators']);
        Permission::create(['name' => 'view calculators']);
        Permission::create(['name' => 'create calculators']);
        Permission::create(['name' => 'update calculators']);
        Permission::create(['name' => 'delete calculators']);

        Permission::create(['name' => 'list caloriearchives']);
        Permission::create(['name' => 'view caloriearchives']);
        Permission::create(['name' => 'create caloriearchives']);
        Permission::create(['name' => 'update caloriearchives']);
        Permission::create(['name' => 'delete caloriearchives']);

        Permission::create(['name' => 'list connectionpoints']);
        Permission::create(['name' => 'view connectionpoints']);
        Permission::create(['name' => 'create connectionpoints']);
        Permission::create(['name' => 'update connectionpoints']);
        Permission::create(['name' => 'delete connectionpoints']);

        Permission::create(['name' => 'list contracts']);
        Permission::create(['name' => 'view contracts']);
        Permission::create(['name' => 'create contracts']);
        Permission::create(['name' => 'update contracts']);
        Permission::create(['name' => 'delete contracts']);

        Permission::create(['name' => 'list contractstatuses']);
        Permission::create(['name' => 'view contractstatuses']);
        Permission::create(['name' => 'create contractstatuses']);
        Permission::create(['name' => 'update contractstatuses']);
        Permission::create(['name' => 'delete contractstatuses']);

        Permission::create(['name' => 'list contracttypes']);
        Permission::create(['name' => 'view contracttypes']);
        Permission::create(['name' => 'create contracttypes']);
        Permission::create(['name' => 'update contracttypes']);
        Permission::create(['name' => 'delete contracttypes']);

        Permission::create(['name' => 'list gasconsumingequipments']);
        Permission::create(['name' => 'view gasconsumingequipments']);
        Permission::create(['name' => 'create gasconsumingequipments']);
        Permission::create(['name' => 'update gasconsumingequipments']);
        Permission::create(['name' => 'delete gasconsumingequipments']);

        Permission::create(['name' => 'list indications']);
        Permission::create(['name' => 'view indications']);
        Permission::create(['name' => 'create indications']);
        Permission::create(['name' => 'update indications']);
        Permission::create(['name' => 'delete indications']);

        Permission::create(['name' => 'list indicationquarters']);
        Permission::create(['name' => 'view indicationquarters']);
        Permission::create(['name' => 'create indicationquarters']);
        Permission::create(['name' => 'update indicationquarters']);
        Permission::create(['name' => 'delete indicationquarters']);

        Permission::create(['name' => 'list indicationsources']);
        Permission::create(['name' => 'view indicationsources']);
        Permission::create(['name' => 'create indicationsources']);
        Permission::create(['name' => 'update indicationsources']);
        Permission::create(['name' => 'delete indicationsources']);

        Permission::create(['name' => 'list indicationstatuses']);
        Permission::create(['name' => 'view indicationstatuses']);
        Permission::create(['name' => 'create indicationstatuses']);
        Permission::create(['name' => 'update indicationstatuses']);
        Permission::create(['name' => 'delete indicationstatuses']);

        Permission::create(['name' => 'list measuringcomplexes']);
        Permission::create(['name' => 'view measuringcomplexes']);
        Permission::create(['name' => 'create measuringcomplexes']);
        Permission::create(['name' => 'update measuringcomplexes']);
        Permission::create(['name' => 'delete measuringcomplexes']);

        Permission::create(['name' => 'list meters']);
        Permission::create(['name' => 'view meters']);
        Permission::create(['name' => 'create meters']);
        Permission::create(['name' => 'update meters']);
        Permission::create(['name' => 'delete meters']);

        Permission::create(['name' => 'list notifications']);
        Permission::create(['name' => 'view notifications']);
        Permission::create(['name' => 'create notifications']);
        Permission::create(['name' => 'update notifications']);
        Permission::create(['name' => 'delete notifications']);

        Permission::create(['name' => 'list notificationstatuses']);
        Permission::create(['name' => 'view notificationstatuses']);
        Permission::create(['name' => 'create notificationstatuses']);
        Permission::create(['name' => 'update notificationstatuses']);
        Permission::create(['name' => 'delete notificationstatuses']);

        Permission::create(['name' => 'list paygasdelivereds']);
        Permission::create(['name' => 'view paygasdelivereds']);
        Permission::create(['name' => 'create paygasdelivereds']);
        Permission::create(['name' => 'update paygasdelivereds']);
        Permission::create(['name' => 'delete paygasdelivereds']);

        Permission::create(['name' => 'list paygasplanneds']);
        Permission::create(['name' => 'view paygasplanneds']);
        Permission::create(['name' => 'create paygasplanneds']);
        Permission::create(['name' => 'update paygasplanneds']);
        Permission::create(['name' => 'delete paygasplanneds']);

        Permission::create(['name' => 'list paytotals']);
        Permission::create(['name' => 'view paytotals']);
        Permission::create(['name' => 'create paytotals']);
        Permission::create(['name' => 'update paytotals']);
        Permission::create(['name' => 'delete paytotals']);

        Permission::create(['name' => 'list paytovdgos']);
        Permission::create(['name' => 'view paytovdgos']);
        Permission::create(['name' => 'create paytovdgos']);
        Permission::create(['name' => 'update paytovdgos']);
        Permission::create(['name' => 'delete paytovdgos']);

        Permission::create(['name' => 'list powerunits']);
        Permission::create(['name' => 'view powerunits']);
        Permission::create(['name' => 'create powerunits']);
        Permission::create(['name' => 'update powerunits']);
        Permission::create(['name' => 'delete powerunits']);

        Permission::create(['name' => 'list pressuregauges']);
        Permission::create(['name' => 'view pressuregauges']);
        Permission::create(['name' => 'create pressuregauges']);
        Permission::create(['name' => 'update pressuregauges']);
        Permission::create(['name' => 'delete pressuregauges']);

        Permission::create(['name' => 'list requestapprovalunevennesses']);
        Permission::create(['name' => 'view requestapprovalunevennesses']);
        Permission::create(['name' => 'create requestapprovalunevennesses']);
        Permission::create(['name' => 'update requestapprovalunevennesses']);
        Permission::create(['name' => 'delete requestapprovalunevennesses']);

        Permission::create(['name' => 'list requestcallemployees']);
        Permission::create(['name' => 'view requestcallemployees']);
        Permission::create(['name' => 'create requestcallemployees']);
        Permission::create(['name' => 'update requestcallemployees']);
        Permission::create(['name' => 'delete requestcallemployees']);

        Permission::create(['name' => 'list thermometers']);
        Permission::create(['name' => 'view thermometers']);
        Permission::create(['name' => 'create thermometers']);
        Permission::create(['name' => 'update thermometers']);
        Permission::create(['name' => 'delete thermometers']);

        Permission::create(['name' => 'list transferindications']);
        Permission::create(['name' => 'view transferindications']);
        Permission::create(['name' => 'create transferindications']);
        Permission::create(['name' => 'update transferindications']);
        Permission::create(['name' => 'delete transferindications']);

        Permission::create(['name' => 'list unallocatedbydates']);
        Permission::create(['name' => 'view unallocatedbydates']);
        Permission::create(['name' => 'create unallocatedbydates']);
        Permission::create(['name' => 'update unallocatedbydates']);
        Permission::create(['name' => 'delete unallocatedbydates']);

        Permission::create(['name' => 'list universalrequests']);
        Permission::create(['name' => 'view universalrequests']);
        Permission::create(['name' => 'create universalrequests']);
        Permission::create(['name' => 'update universalrequests']);
        Permission::create(['name' => 'delete universalrequests']);

        Permission::create(['name' => 'list userprofiles']);
        Permission::create(['name' => 'view userprofiles']);
        Permission::create(['name' => 'create userprofiles']);
        Permission::create(['name' => 'update userprofiles']);
        Permission::create(['name' => 'delete userprofiles']);

        // Create user role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo($currentPermissions);

        // Create admin exclusive permissions
        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'list permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = \App\Models\User::whereEmail('admin@admin.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
