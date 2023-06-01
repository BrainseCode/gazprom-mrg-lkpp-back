@php $editing = isset($userProfile) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full">
        <x-inputs.select name="user_id" label="User" required>
            @php $selected = old('user_id', ($editing ? $userProfile->user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach($users as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="short_name"
            label="Short Name"
            :value="old('short_name', ($editing ? $userProfile->short_name : ''))"
            maxlength="255"
            placeholder="Short Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="full_name"
            label="Full Name"
            :value="old('full_name', ($editing ? $userProfile->full_name : ''))"
            maxlength="255"
            placeholder="Full Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="responsible_person"
            label="Responsible Person"
            :value="old('responsible_person', ($editing ? $userProfile->responsible_person : ''))"
            maxlength="255"
            placeholder="Responsible Person"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="shared_phone"
            label="Shared Phone"
            :value="old('shared_phone', ($editing ? $userProfile->shared_phone : ''))"
            maxlength="255"
            placeholder="Shared Phone"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="responsible_phone"
            label="Responsible Phone"
            :value="old('responsible_phone', ($editing ? $userProfile->responsible_phone : ''))"
            maxlength="255"
            placeholder="Responsible Phone"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="legal_address"
            label="Legal Address"
            :value="old('legal_address', ($editing ? $userProfile->legal_address : ''))"
            maxlength="255"
            placeholder="Legal Address"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.text
            name="postal_address"
            label="Postal Address"
            :value="old('postal_address', ($editing ? $userProfile->postal_address : ''))"
            maxlength="255"
            placeholder="Postal Address"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="inn"
            label="Inn"
            :value="old('inn', ($editing ? $userProfile->inn : ''))"
            max="255"
            placeholder="Inn"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="kpp"
            label="Kpp"
            :value="old('kpp', ($editing ? $userProfile->kpp : ''))"
            max="255"
            placeholder="Kpp"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="ogrn"
            label="Ogrn"
            :value="old('ogrn', ($editing ? $userProfile->ogrn : ''))"
            max="255"
            placeholder="Ogrn"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="okpo"
            label="Okpo"
            :value="old('okpo', ($editing ? $userProfile->okpo : ''))"
            max="255"
            placeholder="Okpo"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="okfs"
            label="Okfs"
            :value="old('okfs', ($editing ? $userProfile->okfs : ''))"
            max="255"
            placeholder="Okfs"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="okato"
            label="Okato"
            :value="old('okato', ($editing ? $userProfile->okato : ''))"
            max="255"
            placeholder="Okato"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="okopf"
            label="Okopf"
            :value="old('okopf', ($editing ? $userProfile->okopf : ''))"
            max="255"
            placeholder="Okopf"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="oktmo"
            label="Oktmo"
            :value="old('oktmo', ($editing ? $userProfile->oktmo : ''))"
            max="255"
            placeholder="Oktmo"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="okved"
            label="Okved"
            :value="old('okved', ($editing ? $userProfile->okved : ''))"
            max="255"
            placeholder="Okved"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="w-full">
        <x-inputs.number
            name="okogu"
            label="Okogu"
            :value="old('okogu', ($editing ? $userProfile->okogu : ''))"
            max="255"
            placeholder="Okogu"
            required
        ></x-inputs.number>
    </x-inputs.group>
</div>
