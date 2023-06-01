<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.user_profiles.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('user-profiles.index') }}" class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.user_profiles.inputs.user_id')
                        </h5>
                        <span
                            >{{ optional($userProfile->user)->name ?? '-'
                            }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.user_profiles.inputs.short_name')
                        </h5>
                        <span>{{ $userProfile->short_name ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.user_profiles.inputs.full_name')
                        </h5>
                        <span>{{ $userProfile->full_name ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.user_profiles.inputs.responsible_person')
                        </h5>
                        <span
                            >{{ $userProfile->responsible_person ?? '-' }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.user_profiles.inputs.shared_phone')
                        </h5>
                        <span>{{ $userProfile->shared_phone ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.user_profiles.inputs.responsible_phone')
                        </h5>
                        <span
                            >{{ $userProfile->responsible_phone ?? '-' }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.user_profiles.inputs.legal_address')
                        </h5>
                        <span>{{ $userProfile->legal_address ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.user_profiles.inputs.postal_address')
                        </h5>
                        <span>{{ $userProfile->postal_address ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.user_profiles.inputs.inn')
                        </h5>
                        <span>{{ $userProfile->inn ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.user_profiles.inputs.kpp')
                        </h5>
                        <span>{{ $userProfile->kpp ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.user_profiles.inputs.ogrn')
                        </h5>
                        <span>{{ $userProfile->ogrn ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.user_profiles.inputs.okpo')
                        </h5>
                        <span>{{ $userProfile->okpo ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.user_profiles.inputs.okfs')
                        </h5>
                        <span>{{ $userProfile->okfs ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.user_profiles.inputs.okato')
                        </h5>
                        <span>{{ $userProfile->okato ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.user_profiles.inputs.okopf')
                        </h5>
                        <span>{{ $userProfile->okopf ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.user_profiles.inputs.oktmo')
                        </h5>
                        <span>{{ $userProfile->oktmo ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.user_profiles.inputs.okved')
                        </h5>
                        <span>{{ $userProfile->okved ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.user_profiles.inputs.okogu')
                        </h5>
                        <span>{{ $userProfile->okogu ?? '-' }}</span>
                    </div>
                </div>

                <div class="mt-10">
                    <a href="{{ route('user-profiles.index') }}" class="button">
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\UserProfile::class)
                    <a
                        href="{{ route('user-profiles.create') }}"
                        class="button"
                    >
                        <i class="mr-1 icon ion-md-add"></i>
                        @lang('crud.common.create')
                    </a>
                    @endcan
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
