@php $editing = isset($requestApprovalUnevenness) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.number
            name="gas_volume"
            label="Gas Volume"
            :value="old('gas_volume', ($editing ? $requestApprovalUnevenness->gas_volume : ''))"
            max="255"
            step="0.01"
            placeholder="Gas Volume"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="gas_volume_unallocated"
            label="Gas Volume Unallocated"
            :value="old('gas_volume_unallocated', ($editing ? $requestApprovalUnevenness->gas_volume_unallocated : ''))"
            max="255"
            step="0.01"
            placeholder="Gas Volume Unallocated"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="total"
            label="Total"
            :value="old('total', ($editing ? $requestApprovalUnevenness->total : ''))"
            max="255"
            step="0.01"
            placeholder="Total"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="user_id" label="User" required>
            @php $selected = old('user_id', ($editing ? $requestApprovalUnevenness->user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach($users as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
