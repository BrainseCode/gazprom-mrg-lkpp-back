@php $editing = isset($unallocatedByDate) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.date
            name="date"
            label="Date"
            value="{{ old('date', ($editing ? optional($unallocatedByDate->date)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="gas_volume"
            label="Gas Volume"
            :value="old('gas_volume', ($editing ? $unallocatedByDate->gas_volume : ''))"
            max="255"
            step="0.01"
            placeholder="Gas Volume"
            required
        ></x-inputs.number>
    </x-inputs.group>
</div>
