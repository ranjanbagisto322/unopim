@php
$attributeId = $field->attribute->id ?? $field->id;
@endphp

<div class="grid gap-4 [grid-template-columns:repeat(auto-fit,_minmax(200px,_1fr))]">

    <!-- Measurement Value -->
    <div class="grid w-full">
        <x-admin::form.control-group.control
            type="text"
            name="{{ $fieldName }}[value]"
            :value="$value['value'] ?? ''"
            placeholder="Enter value"
        />
    </div>

    <!-- Measurement Unit (ASYNC SELECT) -->
    <div class="grid w-full">
        <x-admin::form.control-group.control
            type="select"
            name="{{ $fieldName }}[unit]"
            async="true"
            track-by="id"
            label-by="label"
            :value="$value['unit'] ?? null"
            :list-route="route('admin.measurement.attribute.units', [
                'attribute_id' => $attributeId,
                'queryParams' => [
                    'identifiers' => [
                        'columnName' => 'id',
                        'value'      => $value['unit'] ?? null,
                    ]
                ]
            ])"
        />
    </div>

</div>
