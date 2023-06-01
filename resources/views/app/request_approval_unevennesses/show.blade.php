<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.request_approval_unevennesses.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a
                        href="{{ route('request-approval-unevennesses.index') }}"
                        class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.request_approval_unevennesses.inputs.gas_volume')
                        </h5>
                        <span
                            >{{ $requestApprovalUnevenness->gas_volume ?? '-'
                            }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.request_approval_unevennesses.inputs.gas_volume_unallocated')
                        </h5>
                        <span
                            >{{
                            $requestApprovalUnevenness->gas_volume_unallocated
                            ?? '-' }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.request_approval_unevennesses.inputs.total')
                        </h5>
                        <span
                            >{{ $requestApprovalUnevenness->total ?? '-'
                            }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.request_approval_unevennesses.inputs.user_id')
                        </h5>
                        <span
                            >{{ optional($requestApprovalUnevenness->user)->name
                            ?? '-' }}</span
                        >
                    </div>
                </div>

                <div class="mt-10">
                    <a
                        href="{{ route('request-approval-unevennesses.index') }}"
                        class="button"
                    >
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\RequestApprovalUnevenness::class)
                    <a
                        href="{{ route('request-approval-unevennesses.create') }}"
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
