<?php

namespace Webkul\Measurement\Database\Seeders;

use Illuminate\Database\Seeder;
use Webkul\Measurement\Models\MeasurementFamily;

class MeasurementFamilySeeder extends Seeder
{
    public function run()
    {
        MeasurementFamily::updateOrCreate(
            ['code' => 'length'],
            [
                'name'          => 'Length',
                'labels'        => ['en_US' => 'Length'],
                'standard_unit' => 'meter',
                'symbol'        => 'm',
                'units'         => [
                    ['code' => 'meter', 'labels' => ['en_US' => 'Meter'], 'symbol' => 'm'],
                    ['code' => 'cm', 'labels' => ['en_US' => 'Centimeter'], 'symbol' => 'cm'],
                ],
            ]
        );
    }
}
