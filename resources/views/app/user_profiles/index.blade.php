<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.user_profiles.index_title')
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
                            @can('create', App\Models\UserProfile::class)
                            <a
                                href="{{ route('user-profiles.create') }}"
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
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.user_profiles.inputs.user_id')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.user_profiles.inputs.short_name')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.user_profiles.inputs.full_name')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.user_profiles.inputs.responsible_person')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.user_profiles.inputs.shared_phone')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.user_profiles.inputs.responsible_phone')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.user_profiles.inputs.legal_address')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.user_profiles.inputs.postal_address')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.user_profiles.inputs.inn')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.user_profiles.inputs.kpp')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.user_profiles.inputs.ogrn')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.user_profiles.inputs.okpo')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.user_profiles.inputs.okfs')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.user_profiles.inputs.okato')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.user_profiles.inputs.okopf')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.user_profiles.inputs.oktmo')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.user_profiles.inputs.okved')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.user_profiles.inputs.okogu')
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @forelse($userProfiles as $userProfile)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-left">
                                    {{ optional($userProfile->user)->name ?? '-'
                                    }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $userProfile->short_name ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $userProfile->full_name ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $userProfile->responsible_person ?? '-'
                                    }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $userProfile->shared_phone ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $userProfile->responsible_phone ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $userProfile->legal_address ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $userProfile->postal_address ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{ $userProfile->inn ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{ $userProfile->kpp ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{ $userProfile->ogrn ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{ $userProfile->okpo ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{ $userProfile->okfs ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{ $userProfile->okato ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{ $userProfile->okopf ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{ $userProfile->oktmo ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{ $userProfile->okved ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    {{ $userProfile->okogu ?? '-' }}
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
                                        @can('update', $userProfile)
                                        <a
                                            href="{{ route('user-profiles.edit', $userProfile) }}"
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
                                        @endcan @can('view', $userProfile)
                                        <a
                                            href="{{ route('user-profiles.show', $userProfile) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i class="icon ion-md-eye"></i>
                                            </button>
                                        </a>
                                        @endcan @can('delete', $userProfile)
                                        <form
                                            action="{{ route('user-profiles.destroy', $userProfile) }}"
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
                                <td colspan="19">
                                    @lang('crud.common.no_items_found')
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="19">
                                    <div class="mt-10 px-4">
                                        {!! $userProfiles->render() !!}
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
