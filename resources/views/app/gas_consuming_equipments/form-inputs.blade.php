@php $editing = isset($gasConsumingEquipment) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select
            name="connection_point_id"
            label="Connection Point"
            required
        >
            @php $selected = old('connection_point_id', ($editing ? $gasConsumingEquipment->connection_point_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Connection Point</option>
            @foreach($connectionPoints as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $gasConsumingEquipment->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="quantity"
            label="Quantity"
            :value="old('quantity', ($editing ? $gasConsumingEquipment->quantity : ''))"
            max="255"
            placeholder="Quantity"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="power"
            label="Power"
            :value="old('power', ($editing ? $gasConsumingEquipment->power : ''))"
            max="255"
            step="0.01"
            placeholder="Power"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="consumption"
            label="Consumption"
            :value="old('consumption', ($editing ? $gasConsumingEquipment->consumption : ''))"
            max="255"
            step="0.01"
            placeholder="Consumption"
            required
        ></x-inputs.number>
    </x-inputs.group>
</div>
