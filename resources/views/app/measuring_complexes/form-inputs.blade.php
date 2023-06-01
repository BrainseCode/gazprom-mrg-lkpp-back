@php $editing = isset($measuringComplex) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select
            name="connection_point_id"
            label="Connection Point"
            required
        >
            @php $selected = old('connection_point_id', ($editing ? $measuringComplex->connection_point_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Connection Point</option>
            @foreach($connectionPoints as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="number"
            label="Number"
            :value="old('number', ($editing ? $measuringComplex->number : ''))"
            max="255"
            placeholder="Number"
            required
        ></x-inputs.number>
    </x-inputs.group>
</div>
