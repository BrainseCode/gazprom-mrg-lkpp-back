<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>

                <x-nav-dropdown title="Apps" align="right" width="48">
                        @can('view-any', App\Models\User::class)
                        <x-dropdown-link href="{{ route('users.index') }}">
                        Users
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\UserProfile::class)
                        <x-dropdown-link href="{{ route('user-profiles.index') }}">
                        User Profiles
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\Contract::class)
                        <x-dropdown-link href="{{ route('contracts.index') }}">
                        Contracts
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\ConnectionPoint::class)
                        <x-dropdown-link href="{{ route('connection-points.index') }}">
                        Connection Points
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\MeasuringComplex::class)
                        <x-dropdown-link href="{{ route('measuring-complexes.index') }}">
                        Measuring Complexes
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\AllIndicationQuarter::class)
                        <x-dropdown-link href="{{ route('all-indication-quarters.index') }}">
                        All Indication Quarters
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\Calculator::class)
                        <x-dropdown-link href="{{ route('calculators.index') }}">
                        Calculators
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\CalorieArchive::class)
                        <x-dropdown-link href="{{ route('calorie-archives.index') }}">
                        Calorie Archives
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\ContractStatus::class)
                        <x-dropdown-link href="{{ route('contract-statuses.index') }}">
                        Contract Statuses
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\ContractType::class)
                        <x-dropdown-link href="{{ route('contract-types.index') }}">
                        Contract Types
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\GasConsumingEquipment::class)
                        <x-dropdown-link href="{{ route('gas-consuming-equipments.index') }}">
                        Gas Consuming Equipments
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\Indication::class)
                        <x-dropdown-link href="{{ route('indications.index') }}">
                        Indications
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\IndicationQuarter::class)
                        <x-dropdown-link href="{{ route('indication-quarters.index') }}">
                        Indication Quarters
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\IndicationSource::class)
                        <x-dropdown-link href="{{ route('indication-sources.index') }}">
                        Indication Sources
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\IndicationStatus::class)
                        <x-dropdown-link href="{{ route('indication-statuses.index') }}">
                        Indication Statuses
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\Meter::class)
                        <x-dropdown-link href="{{ route('meters.index') }}">
                        Meters
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\Notification::class)
                        <x-dropdown-link href="{{ route('notifications.index') }}">
                        Notifications
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\NotificationStatus::class)
                        <x-dropdown-link href="{{ route('notification-statuses.index') }}">
                        Notification Statuses
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\PayGasDelivered::class)
                        <x-dropdown-link href="{{ route('pay-gas-delivereds.index') }}">
                        Pay Gas Delivereds
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\PayGasPlanned::class)
                        <x-dropdown-link href="{{ route('pay-gas-planneds.index') }}">
                        Pay Gas Planneds
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\PayTotal::class)
                        <x-dropdown-link href="{{ route('pay-totals.index') }}">
                        Pay Totals
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\PayTovdgo::class)
                        <x-dropdown-link href="{{ route('pay-tovdgos.index') }}">
                        Pay Tovdgos
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\PowerUnit::class)
                        <x-dropdown-link href="{{ route('power-units.index') }}">
                        Power Units
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\PressureGauge::class)
                        <x-dropdown-link href="{{ route('pressure-gauges.index') }}">
                        Pressure Gauges
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\RequestApprovalUnevenness::class)
                        <x-dropdown-link href="{{ route('request-approval-unevennesses.index') }}">
                        Request Approval Unevennesses
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\RequestCallEmployee::class)
                        <x-dropdown-link href="{{ route('request-call-employees.index') }}">
                        Request Call Employees
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\Thermometer::class)
                        <x-dropdown-link href="{{ route('thermometers.index') }}">
                        Thermometers
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\TransferIndication::class)
                        <x-dropdown-link href="{{ route('transfer-indications.index') }}">
                        Transfer Indications
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\UnallocatedByDate::class)
                        <x-dropdown-link href="{{ route('unallocated-by-dates.index') }}">
                        Unallocated By Dates
                        </x-dropdown-link>
                        @endcan
                        @can('view-any', App\Models\UniversalRequest::class)
                        <x-dropdown-link href="{{ route('universal-requests.index') }}">
                        Universal Requests
                        </x-dropdown-link>
                        @endcan
                </x-nav-dropdown>

                @if (Auth::user()->can('view-any', Spatie\Permission\Models\Role::class) || 
                    Auth::user()->can('view-any', Spatie\Permission\Models\Permission::class))
                <x-nav-dropdown title="Access Management" align="right" width="48">
                    
                    @can('view-any', Spatie\Permission\Models\Role::class)
                    <x-dropdown-link href="{{ route('roles.index') }}">Roles</x-dropdown-link>
                    @endcan
                
                    @can('view-any', Spatie\Permission\Models\Permission::class)
                    <x-dropdown-link href="{{ route('permissions.index') }}">Permissions</x-dropdown-link>
                    @endcan
                    
                </x-nav-dropdown>
                @endif
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

                @can('view-any', App\Models\User::class)
                <x-responsive-nav-link href="{{ route('users.index') }}">
                Users
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\UserProfile::class)
                <x-responsive-nav-link href="{{ route('user-profiles.index') }}">
                User Profiles
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Contract::class)
                <x-responsive-nav-link href="{{ route('contracts.index') }}">
                Contracts
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\ConnectionPoint::class)
                <x-responsive-nav-link href="{{ route('connection-points.index') }}">
                Connection Points
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\MeasuringComplex::class)
                <x-responsive-nav-link href="{{ route('measuring-complexes.index') }}">
                Measuring Complexes
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\AllIndicationQuarter::class)
                <x-responsive-nav-link href="{{ route('all-indication-quarters.index') }}">
                All Indication Quarters
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Calculator::class)
                <x-responsive-nav-link href="{{ route('calculators.index') }}">
                Calculators
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\CalorieArchive::class)
                <x-responsive-nav-link href="{{ route('calorie-archives.index') }}">
                Calorie Archives
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\ContractStatus::class)
                <x-responsive-nav-link href="{{ route('contract-statuses.index') }}">
                Contract Statuses
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\ContractType::class)
                <x-responsive-nav-link href="{{ route('contract-types.index') }}">
                Contract Types
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\GasConsumingEquipment::class)
                <x-responsive-nav-link href="{{ route('gas-consuming-equipments.index') }}">
                Gas Consuming Equipments
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Indication::class)
                <x-responsive-nav-link href="{{ route('indications.index') }}">
                Indications
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\IndicationQuarter::class)
                <x-responsive-nav-link href="{{ route('indication-quarters.index') }}">
                Indication Quarters
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\IndicationSource::class)
                <x-responsive-nav-link href="{{ route('indication-sources.index') }}">
                Indication Sources
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\IndicationStatus::class)
                <x-responsive-nav-link href="{{ route('indication-statuses.index') }}">
                Indication Statuses
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Meter::class)
                <x-responsive-nav-link href="{{ route('meters.index') }}">
                Meters
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Notification::class)
                <x-responsive-nav-link href="{{ route('notifications.index') }}">
                Notifications
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\NotificationStatus::class)
                <x-responsive-nav-link href="{{ route('notification-statuses.index') }}">
                Notification Statuses
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\PayGasDelivered::class)
                <x-responsive-nav-link href="{{ route('pay-gas-delivereds.index') }}">
                Pay Gas Delivereds
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\PayGasPlanned::class)
                <x-responsive-nav-link href="{{ route('pay-gas-planneds.index') }}">
                Pay Gas Planneds
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\PayTotal::class)
                <x-responsive-nav-link href="{{ route('pay-totals.index') }}">
                Pay Totals
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\PayTovdgo::class)
                <x-responsive-nav-link href="{{ route('pay-tovdgos.index') }}">
                Pay Tovdgos
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\PowerUnit::class)
                <x-responsive-nav-link href="{{ route('power-units.index') }}">
                Power Units
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\PressureGauge::class)
                <x-responsive-nav-link href="{{ route('pressure-gauges.index') }}">
                Pressure Gauges
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\RequestApprovalUnevenness::class)
                <x-responsive-nav-link href="{{ route('request-approval-unevennesses.index') }}">
                Request Approval Unevennesses
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\RequestCallEmployee::class)
                <x-responsive-nav-link href="{{ route('request-call-employees.index') }}">
                Request Call Employees
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\Thermometer::class)
                <x-responsive-nav-link href="{{ route('thermometers.index') }}">
                Thermometers
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\TransferIndication::class)
                <x-responsive-nav-link href="{{ route('transfer-indications.index') }}">
                Transfer Indications
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\UnallocatedByDate::class)
                <x-responsive-nav-link href="{{ route('unallocated-by-dates.index') }}">
                Unallocated By Dates
                </x-responsive-nav-link>
                @endcan
                @can('view-any', App\Models\UniversalRequest::class)
                <x-responsive-nav-link href="{{ route('universal-requests.index') }}">
                Universal Requests
                </x-responsive-nav-link>
                @endcan

                @if (Auth::user()->can('view-any', Spatie\Permission\Models\Role::class) || 
                    Auth::user()->can('view-any', Spatie\Permission\Models\Permission::class))
                    
                    @can('view-any', Spatie\Permission\Models\Role::class)
                    <x-responsive-nav-link href="{{ route('roles.index') }}">Roles</x-responsive-nav-link>
                    @endcan
                
                    @can('view-any', Spatie\Permission\Models\Permission::class)
                    <x-responsive-nav-link href="{{ route('permissions.index') }}">Permissions</x-responsive-nav-link>
                    @endcan
                    
                @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                <div class="shrink-0">
                    <svg class="h-10 w-10 fill-current text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>

                <div class="ml-3">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-dropdown-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-dropdown-link>
                
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>