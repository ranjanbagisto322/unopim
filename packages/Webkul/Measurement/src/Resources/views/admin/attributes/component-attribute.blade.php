@php

    $fieldLabel = $field->translate(core()->getRequestedLocaleCode())['name'] ?? '';
    $fieldLabel = empty($fieldLabel) ? '[' . $field->code . ']' : $fieldLabel;
    
    // Value ko safely read karo
    $measurementValue = is_array($value) ? ($value['value'] ?? '') : '';
    $measurementUnit  = is_array($value) ? ($value['unit'] ?? '') : '';
@endphp

<div class="grid gap-4 [grid-template-columns:repeat(auto-fit,_minmax(200px,_1fr))]">

    <!-- Measurement Value -->
    <div class="grid w-full">
        <x-admin::form.control-group.control
            type="text"
            id="{{ $field->code }}_value"
            name="{{ $fieldName }}[value]"
            :label="$fieldLabel"
            :value="$measurementValue"
            placeholder="Enter value"
        />

        <x-admin::form.control-group.error
            :control-name="$fieldName . '[value]'"
        />
    </div>

    <!-- Measurement Unit -->
    <div class="grid w-full">
        <x-admin::form.control-group.control
            type="select"
            id="{{ $field->code }}_unit"
            name="{{ $fieldName }}[unit]"
            label="Unit"
        >
            <option value="">Select Unit</option>
            <option value="cm" @selected($measurementUnit === 'cm')>Centimeter (cm)</option>
            <option value="m"  @selected($measurementUnit === 'm')>Meter (m)</option>
            <option value="kg" @selected($measurementUnit === 'kg')>Kilogram (kg)</option>
            <option value="g"  @selected($measurementUnit === 'g')>Gram (g)</option>
        </x-admin::form.control-group.control>

        <x-admin::form.control-group.error
            :control-name="$fieldName . '[unit]'"
        />
    </div>

</div>
