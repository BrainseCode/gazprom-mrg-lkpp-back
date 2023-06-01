<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.indication_quarters.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a
                        href="{{ route('indication-quarters.index') }}"
                        class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.indication_quarters.inputs.connection_point_id')
                        </h5>
                        <span
                            >{{
                            optional($indicationQuarter->connectionPoint)->address
                            ?? '-' }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.indication_quarters.inputs.date_year')
                        </h5>
                        <span>{{ $indicationQuarter->date_year ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.indication_quarters.inputs.year')
                        </h5>
                        <span>{{ $indicationQuarter->year ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.indication_quarters.inputs.quarter_1')
                        </h5>
                        <span>{{ $indicationQuarter->quarter_1 ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.indication_quarters.inputs.quarter_2')
                        </h5>
                        <span>{{ $indicationQuarter->quarter_2 ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.indication_quarters.inputs.quarter_3')
                        </h5>
                        <span>{{ $indicationQuarter->quarter_3 ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.indication_quarters.inputs.quarter_4')
                        </h5>
                        <span>{{ $indicationQuarter->quarter_4 ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.indication_quarters.inputs.january')
                        </h5>
                        <span>{{ $indicationQuarter->january ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.indication_quarters.inputs.february')
                        </h5>
                        <span>{{ $indicationQuarter->february ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.indication_quarters.inputs.march')
                        </h5>
                        <span>{{ $indicationQuarter->march ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.indication_quarters.inputs.april')
                        </h5>
                        <span>{{ $indicationQuarter->april ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.indication_quarters.inputs.may')
                        </h5>
                        <span>{{ $indicationQuarter->may ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.indication_quarters.inputs.june')
                        </h5>
                        <span>{{ $indicationQuarter->june ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.indication_quarters.inputs.july')
                        </h5>
                        <span>{{ $indicationQuarter->july ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.indication_quarters.inputs.august')
                        </h5>
                        <span>{{ $indicationQuarter->august ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.indication_quarters.inputs.september')
                        </h5>
                        <span>{{ $indicationQuarter->september ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.indication_quarters.inputs.october')
                        </h5>
                        <span>{{ $indicationQuarter->october ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.indication_quarters.inputs.november')
                        </h5>
                        <span>{{ $indicationQuarter->november ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.indication_quarters.inputs.december')
                        </h5>
                        <span>{{ $indicationQuarter->december ?? '-' }}</span>
                    </div>
                </div>

                <div class="mt-10">
                    <a
                        href="{{ route('indication-quarters.index') }}"
                        class="button"
                    >
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\IndicationQuarter::class)
                    <a
                        href="{{ route('indication-quarters.create') }}"
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
