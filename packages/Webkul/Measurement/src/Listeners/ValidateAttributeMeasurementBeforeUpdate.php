<?php

namespace Webkul\Measurement\Listeners;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Session;
use Webkul\Measurement\Repository\AttributeMeasurementRepository;

class ValidateAttributeMeasurementBeforeUpdate
{
    protected $attributeMeasurementRepository;

    public function __construct(AttributeMeasurementRepository $attributeMeasurementRepository)
    {
        $this->attributeMeasurementRepository = $attributeMeasurementRepository;
    }

    public function handle($attributeId)
    {
        $familyCode = request('measurement_family');
        $unitCode = request('measurement_unit');

        if (! $familyCode || ! $unitCode) {
            Session::flash('error', 'Measurement Family and Unit are required.');
            throw new HttpResponseException(
                redirect()->back()->withInput()
            );
        }

        $familyExists = app(\Webkul\Measurement\Models\MeasurementFamily::class)
            ->where('code', $familyCode)
            ->exists();

        if (! $familyExists) {
            Session::flash('error', 'Selected Measurement Family does not exist.');
            throw new HttpResponseException(
                redirect()->back()->withInput()
            );
        }

    
        $this->attributeMeasurementRepository->saveAttributeMeasurement($attributeId, [
            'family_code' => $familyCode,
            'unit_code'   => $unitCode,
        ]);
    }
}
