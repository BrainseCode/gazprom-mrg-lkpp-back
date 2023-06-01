@php $editing = isset($indication) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select
            name="connection_point_id"
            label="Connection Point"
            required
        >
            @php $selected = old('connection_point_id', ($editing ? $indication->connection_point_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Connection Point</option>
            @foreach($connectionPoints as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.date
            name="date"
            label="Date"
            value="{{ old('date', ($editing ? optional($indication->date)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="volume"
            label="Volume"
            :value="old('volume', ($editing ? $indication->volume : ''))"
            max="255"
            step="0.01"
            placeholder="Volume"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="plan"
            label="Plan"
            :value="old('plan', ($editing ? $indication->plan : ''))"
            max="255"
            step="0.01"
            placeholder="Plan"
            required
        ></x-inputs.number>
    </x-inputs.group>
</div>
