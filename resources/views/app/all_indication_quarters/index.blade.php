<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.all_indication_quarters.index_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <div class="mb-5 mt-4">
                    <div class="flex flex-wrap justify-between">
                        <div class="md:w-1/2">
                            <form>
                                <div class="flex items-center w-full">
                                    <x-inputs.text
                                        name="search"
                                        value="{{ $search ?? '' }}"
                                        placeholder="{{ __('crud.common.search') }}"
                                        autocomplete="off"
                                    ></x-inputs.text>

                                    <div class="ml-1">
                                        <button
                                            type="submit"
                                            class="button button-primary"
                                        >
                                            <i class="icon ion-md-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="md:w-1/2 text-right">
                            @can('create',
                            App\Models\AllIndicationQuarter::class)
                            <a
                                href="{{ route('all-indication-quarters.create') }}"
                                class="button button-primary"
                            >
                                <i class="mr-1 icon ion-md-add"></i>
                                @lang('crud.common.create')
                            </a>
                            @endcan
                        </div>
                    </div>
                </div>

                <div class="block w-full overflow-auto scrolling-touch">
                    <table class="w-full max-w-full mb-4 bg-transparent">
                        <thead class="text-gray-700">
                            <tr>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.all_indication_quarters.inputs.date_year')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.all_indication_quarters.inputs.year')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.all_indication_quarters.inputs.quarter_1')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.all_indication_quarters.inputs.quarter_2')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.all_indication_quarters.inputs.quarter_3')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.all_indication_quarters.inputs.quarter_4')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.all_indication_quarters.inputs.january')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.all_indication_quarters.inputs.february')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.all_indication_quarters.inputs.march')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.all_indication_quarters.inputs.april')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.all_indication_quarters.inputs.may')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.all_indication_quarters.inputs.june')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.all_indication_quarters.inputs.july')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.all_indication_quarters.inputs.august')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.all_indication_quarters.inputs.september')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.all_indication_quarters.inputs.october')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.all_indication_quarters.inputs.november')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.all_indication_quarters.inputs.december')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.all_indication_quarters.inputs.contract_id')
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @forelse($allIndicationQuarters as
                            $allIndicationQuarter)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-right">
                                    {{ $allIndicationQuarter->date_year ?? '-'
                                    }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{ $allIndicationQuarter->year ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{ $allIndicationQuarter->quarter_1 ?? '-'
                                    }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{ $allIndicationQuarter->quarter_2 ?? '-'
                                    }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{ $allIndicationQuarter->quarter_3 ?? '-'
                                    }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{ $allIndicationQuarter->quarter_4 ?? '-'
                                    }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{ $allIndicationQuarter->january ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{ $allIndicationQuarter->february ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{ $allIndicationQuarter->march ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{ $allIndicationQuarter->april ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{ $allIndicationQuarter->may ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{ $allIndicationQuarter->june ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{ $allIndicationQuarter->july ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{ $allIndicationQuarter->august ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{ $allIndicationQuarter->september ?? '-'
                                    }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{ $allIndicationQuarter->october ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{ $allIndicationQuarter->november ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{ $allIndicationQuarter->december ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{
                                    optional($allIndicationQuarter->contract)->name
                                    ?? '-' }}
                                </td>
                                <td
                                    class="px-4 py-3 text-center"
                                    style="width: 134px;"
                                >
                                    <div
                                        role="group"
                                        aria-label="Row Actions"
                                        class="
                                            relative
                                            inline-flex
                                            align-middle
                                        "
                                    >
                                        @can('update', $allIndicationQuarter)
                                        <a
                                            href="{{ route('all-indication-quarters.edit', $allIndicationQuarter) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i
                                                    class="icon ion-md-create"
                                                ></i>
                                            </button>
                                        </a>
                                        @endcan @can('view',
                                        $allIndicationQuarter)
                                        <a
                                            href="{{ route('all-indication-quarters.show', $allIndicationQuarter) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i class="icon ion-md-eye"></i>
                                            </button>
                                        </a>
                                        @endcan @can('delete',
                                        $allIndicationQuarter)
                                        <form
                                            action="{{ route('all-indication-quarters.destroy', $allIndicationQuarter) }}"
                                            method="POST"
                                            onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                        >
                                            @csrf @method('DELETE')
                                            <button
                                                type="submit"
                                                class="button"
                                            >
                                                <i
                                                    class="
                                                        icon
                                                        ion-md-trash
                                                        text-red-600
                                                    "
                                                ></i>
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="20">
                                    @lang('crud.common.no_items_found')
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="20">
                                    <div class="mt-10 px-4">
                                        {!! $allIndicationQuarters->render() !!}
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
