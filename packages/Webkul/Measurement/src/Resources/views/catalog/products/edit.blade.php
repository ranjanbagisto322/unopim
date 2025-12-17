@php
use Webkul\Measurement\Repository\AttributeMeasurementRepository;

/**
 * Product attribute id
 */
$attributeId = $field->attribute->id ?? $field->id;

/**
 * Attribute → Measurement mapping
 */
$attributeMeasurement = app(AttributeMeasurementRepository::class)
    ->getByAttributeId($attributeId);

$measurementValue = $value['value'] ?? '';
@endphp

<div class="grid gap-4 [grid-template-columns:repeat(auto-fit,_minmax(200px,_1fr))]">

    <!-- Measurement Value -->
    <div class="grid w-full">
        <x-admin::form.control-group.control
            type="text"
            name="{{ $fieldName }}[value]"
            :value="$measurementValue"
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

            :value="$value['unit']"
            :list-route="route('admin.measurement.attribute.units', [
                'family' => $attributeMeasurement?->family_code,
                'queryParams' => [
                    'identifiers' => [
                        'columnName' => 'id',
                        'value'      => $value['unit'],
                    ]
                ]
            ])"
        />

    </div>

</div>
