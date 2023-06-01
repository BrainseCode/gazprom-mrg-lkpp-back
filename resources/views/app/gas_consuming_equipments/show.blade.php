<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.gas_consuming_equipments.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a
                        href="{{ route('gas-consuming-equipments.index') }}"
                        class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.gas_consuming_equipments.inputs.connection_point_id')
                        </h5>
                        <span
                            >{{
                            optional($gasConsumingEquipment->connectionPoint)->address
                            ?? '-' }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.gas_consuming_equipments.inputs.name')
                        </h5>
                        <span>{{ $gasConsumingEquipment->name ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.gas_consuming_equipments.inputs.quantity')
                        </h5>
                        <span
                            >{{ $gasConsumingEquipment->quantity ?? '-' }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.gas_consuming_equipments.inputs.power')
                        </h5>
                        <span>{{ $gasConsumingEquipment->power ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.gas_consuming_equipments.inputs.consumption')
                        </h5>
                        <span
                            >{{ $gasConsumingEquipment->consumption ?? '-'
                            }}</span
                        >
                    </div>
                </div>

                <div class="mt-10">
                    <a
                        href="{{ route('gas-consuming-equipments.index') }}"
                        class="button"
                    >
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\GasConsumingEquipment::class)
                    <a
                        href="{{ route('gas-consuming-equipments.create') }}"
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
