<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.request_approval_unevennesses.index_title')
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
                            App\Models\RequestApprovalUnevenness::class)
                            <a
                                href="{{ route('request-approval-unevennesses.create') }}"
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
                                    @lang('crud.request_approval_unevennesses.inputs.gas_volume')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.request_approval_unevennesses.inputs.gas_volume_unallocated')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.request_approval_unevennesses.inputs.total')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.request_approval_unevennesses.inputs.user_id')
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @forelse($requestApprovalUnevennesses as
                            $requestApprovalUnevenness)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-right">
                                    {{ $requestApprovalUnevenness->gas_volume ??
                                    '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{
                                    $requestApprovalUnevenness->gas_volume_unallocated
                                    ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{ $requestApprovalUnevenness->total ?? '-'
                                    }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{
                                    optional($requestApprovalUnevenness->user)->name
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
                                        @can('update',
                                        $requestApprovalUnevenness)
                                        <a
                                            href="{{ route('request-approval-unevennesses.edit', $requestApprovalUnevenness) }}"
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
                                        $requestApprovalUnevenness)
                                        <a
                                            href="{{ route('request-approval-unevennesses.show', $requestApprovalUnevenness) }}"
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
                                        $requestApprovalUnevenness)
                                        <form
                                            action="{{ route('request-approval-unevennesses.destroy', $requestApprovalUnevenness) }}"
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
                                <td colspan="5">
                                    @lang('crud.common.no_items_found')
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5">
                                    <div class="mt-10 px-4">
                                        {!!
                                        $requestApprovalUnevennesses->render()
                                        !!}
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
