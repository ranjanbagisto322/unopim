@php
use Webkul\Measurement\Repository\AttributeMeasurementRepository;
use Webkul\Measurement\Repository\MeasurementFamilyRepository;

/**
 * Product blade me $field->id hamesha attribute id nahi hoti
 */
$attributeId = $field->attribute->id ?? $field->id;

/** Attribute → Measurement mapping */
$attributeMeasurement = app(AttributeMeasurementRepository::class)
    ->getByAttributeId($attributeId);

/** Family code */
$familyCode = $attributeMeasurement?->family_code;

/** Family → Units */
$units = app(MeasurementFamilyRepository::class)
    ->getUnitsByFamilyCode($familyCode);

/** Build options for select */
$unitOptions = [];

foreach ($units as $unit) {
    $unitOptions[] = [
        'id'    => $unit['code'] ?? '',
        'label' => $unit['code'] ?? $unit['label'] ?? '',
    ];
}


$unitOptionsInJson = json_encode($unitOptions);

/** Product stored value */
$measurementValue = '';
$measurementUnit  = '';
if (is_array($value)) {
    $measurementValue = $value['value'] ?? '';
    $measurementUnit  = $value['unit'] ?? '';
}
@endphp

<div class="grid gap-4 [grid-template-columns:repeat(auto-fit,_minmax(200px,_1fr))]">

    <!-- Value -->
    <div class="grid w-full">
        <x-admin::form.control-group.control
            type="text"
            name="{{ $fieldName }}[value]"
            :value="$measurementValue"
            placeholder="Enter value"
        />
    </div>

    <!-- Unit -->
    <div class="grid w-full">
        <x-admin::form.control-group.control
            type="select"
            name="{{ $fieldName }}[unit]"
            label="Unit"
            :options="$unitOptionsInJson"
            :value="$measurementUnit"
            track-by="id"
            label-by="label"
        />
    </div>

</div>
