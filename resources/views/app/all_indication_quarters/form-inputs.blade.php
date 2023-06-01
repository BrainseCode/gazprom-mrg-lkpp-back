@php $editing = isset($allIndicationQuarter) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.number
            name="date_year"
            label="Date Year"
            :value="old('date_year', ($editing ? $allIndicationQuarter->date_year : ''))"
            max="255"
            placeholder="Date Year"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="year"
            label="Year"
            :value="old('year', ($editing ? $allIndicationQuarter->year : ''))"
            max="255"
            step="0.01"
            placeholder="Year"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="quarter_1"
            label="Quarter 1"
            :value="old('quarter_1', ($editing ? $allIndicationQuarter->quarter_1 : ''))"
            max="255"
            step="0.01"
            placeholder="Quarter 1"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="quarter_2"
            label="Quarter 2"
            :value="old('quarter_2', ($editing ? $allIndicationQuarter->quarter_2 : ''))"
            max="255"
            step="0.01"
            placeholder="Quarter 2"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="quarter_3"
            label="Quarter 3"
            :value="old('quarter_3', ($editing ? $allIndicationQuarter->quarter_3 : ''))"
            max="255"
            step="0.01"
            placeholder="Quarter 3"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="quarter_4"
            label="Quarter 4"
            :value="old('quarter_4', ($editing ? $allIndicationQuarter->quarter_4 : ''))"
            max="255"
            step="0.01"
            placeholder="Quarter 4"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="january"
            label="January"
            :value="old('january', ($editing ? $allIndicationQuarter->january : ''))"
            max="255"
            step="0.01"
            placeholder="January"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="february"
            label="February"
            :value="old('february', ($editing ? $allIndicationQuarter->february : ''))"
            max="255"
            step="0.01"
            placeholder="February"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="march"
            label="March"
            :value="old('march', ($editing ? $allIndicationQuarter->march : ''))"
            max="255"
            step="0.01"
            placeholder="March"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="april"
            label="April"
            :value="old('april', ($editing ? $allIndicationQuarter->april : ''))"
            max="255"
            step="0.01"
            placeholder="April"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="may"
            label="May"
            :value="old('may', ($editing ? $allIndicationQuarter->may : ''))"
            max="255"
            step="0.01"
            placeholder="May"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="june"
            label="June"
            :value="old('june', ($editing ? $allIndicationQuarter->june : ''))"
            max="255"
            step="0.01"
            placeholder="June"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="july"
            label="July"
            :value="old('july', ($editing ? $allIndicationQuarter->july : ''))"
            max="255"
            step="0.01"
            placeholder="July"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="august"
            label="August"
            :value="old('august', ($editing ? $allIndicationQuarter->august : ''))"
            max="255"
            step="0.01"
            placeholder="August"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="september"
            label="September"
            :value="old('september', ($editing ? $allIndicationQuarter->september : ''))"
            max="255"
            step="0.01"
            placeholder="September"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="october"
            label="October"
            :value="old('october', ($editing ? $allIndicationQuarter->october : ''))"
            max="255"
            step="0.01"
            placeholder="October"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="november"
            label="November"
            :value="old('november', ($editing ? $allIndicationQuarter->november : ''))"
            max="255"
            step="0.01"
            placeholder="November"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="december"
            label="December"
            :value="old('december', ($editing ? $allIndicationQuarter->december : ''))"
            max="255"
            step="0.01"
            placeholder="December"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.select name="contract_id" label="Contract" required>
            @php $selected = old('contract_id', ($editing ? $allIndicationQuarter->contract_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Contract</option>
            @foreach($contracts as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
