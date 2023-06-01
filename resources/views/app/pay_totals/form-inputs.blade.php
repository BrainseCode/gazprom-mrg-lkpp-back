@php $editing = isset($payTotal) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.number
            name="pay_delivered"
            label="Pay Delivered"
            :value="old('pay_delivered', ($editing ? $payTotal->pay_delivered : ''))"
            max="255"
            step="0.01"
            placeholder="Pay Delivered"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="pay_planned"
            label="Pay Planned"
            :value="old('pay_planned', ($editing ? $payTotal->pay_planned : ''))"
            max="255"
            step="0.01"
            placeholder="Pay Planned"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="pay_tovdgo"
            label="Pay Tovdgo"
            :value="old('pay_tovdgo', ($editing ? $payTotal->pay_tovdgo : ''))"
            max="255"
            step="0.01"
            placeholder="Pay Tovdgo"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="total"
            label="Total"
            :value="old('total', ($editing ? $payTotal->total : ''))"
            max="255"
            step="0.01"
            placeholder="Total"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="total_nds"
            label="Total Nds"
            :value="old('total_nds', ($editing ? $payTotal->total_nds : ''))"
            max="255"
            step="0.01"
            placeholder="Total Nds"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="contract_id" label="Contract" required>
            @php $selected = old('contract_id', ($editing ? $payTotal->contract_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Contract</option>
            @foreach($contracts as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
