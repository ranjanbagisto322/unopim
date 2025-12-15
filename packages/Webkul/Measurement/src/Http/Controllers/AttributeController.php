<?php

namespace Webkul\Measurement\Http\Controllers;

use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Measurement\Repository\MeasurementFamilyRepository;

class AttributeController extends Controller
{
    protected $familyRepository;

    public function __construct(MeasurementFamilyRepository $familyRepository)
    {
        $this->familyRepository = $familyRepository;
    }

    public function customFieldData()
    {
        $families = $this->familyRepository->all();

        $familyOptions = $families->map(function ($f) {
            return [
                'id'    => $f->code,
                'label' => $f->name,

                // FIXED 🔥
                'units' => collect($f->units ?? [])->map(function ($u) {
                    return [
                        'id'    => $u['code'],
                        'label' => $u['labels']['en_US'] ?? $u['code'],
                    ];
                })->values()->toArray(),
            ];
        })->values()->toArray();
        
        return [
            'familyOptions' => $familyOptions,
        ];
    }
}
