@php
    $attributeId = $field->attribute->id ?? $field->id;
    $currentValue = $value['value'] ?? '';
    $currentUnit  = empty($currentValue) ? '__auto__' : ($value['unit'] ?? '__auto__');
@endphp

<div class="grid gap-4 [grid-template-columns:repeat(auto-fit,_minmax(200px,_1fr))]">

    {{-- Value Field --}}
    <div class="grid w-full">
        <x-admin::form.control-group.control
            type="text"
            name="{{ $fieldName }}[value]"
            :value="$currentValue"
            placeholder="Enter value"
            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');"
        />
    </div>

    {{-- Unit Field --}}
    <div class="grid w-full">
        <x-admin::form.control-group.control
            type="select"
            name="{{ $fieldName }}[unit]"
            async="true"
            track-by="id"
            label-by="label"

            :value="$currentUnit"

            :list-route="route('admin.measurement.attribute.units', [
                'attribute_id' => $attributeId,
                'queryParams' => [
                    'identifiers' => [
                        'columnName' => 'id',
                        'value'      => $currentUnit,
                    ]
                ]
            ])"
        />
    </div>
</div>