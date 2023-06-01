@php $editing = isset($pressureGauge) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select
            name="measuring_complex_id"
            label="Measuring Complex"
            required
        >
            @php $selected = old('measuring_complex_id', ($editing ? $pressureGauge->measuring_complex_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Measuring Complex</option>
            @foreach($measuringComplexes as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="name"
            label="Name"
            :value="old('name', ($editing ? $pressureGauge->name : ''))"
            maxlength="255"
            placeholder="Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="number"
            label="Number"
            :value="old('number', ($editing ? $pressureGauge->number : ''))"
            max="255"
            placeholder="Number"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.date
            name="verification_date"
            label="Verification Date"
            value="{{ old('verification_date', ($editing ? optional($pressureGauge->verification_date)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>
</div>
