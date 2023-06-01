@php $editing = isset($payGasDelivered) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.date
            name="date"
            label="Date"
            value="{{ old('date', ($editing ? optional($payGasDelivered->date)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="summ"
            label="Summ"
            :value="old('summ', ($editing ? $payGasDelivered->summ : ''))"
            max="255"
            step="0.01"
            placeholder="Summ"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.checkbox
            name="status_pay"
            label="Status Pay"
            :checked="old('status_pay', ($editing ? $payGasDelivered->status_pay : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="contract_id" label="Contract" required>
            @php $selected = old('contract_id', ($editing ? $payGasDelivered->contract_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Contract</option>
            @foreach($contracts as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
