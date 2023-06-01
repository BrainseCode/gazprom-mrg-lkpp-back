@php $editing = isset($calorieArchive) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.date
            name="date"
            label="Date"
            value="{{ old('date', ($editing ? optional($calorieArchive->date)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="caloric"
            label="Caloric"
            :value="old('caloric', ($editing ? $calorieArchive->caloric : ''))"
            max="255"
            step="0.01"
            placeholder="Caloric"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="quality_passport"
            label="Quality Passport"
            :value="old('quality_passport', ($editing ? $calorieArchive->quality_passport : ''))"
            maxlength="255"
            placeholder="Quality Passport"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="contract_id" label="Contract" required>
            @php $selected = old('contract_id', ($editing ? $calorieArchive->contract_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Contract</option>
            @foreach($contracts as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
