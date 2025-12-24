<?php

namespace Webkul\Measurement\Database\Seeders;

use Illuminate\Database\Seeder;
use Webkul\Measurement\Models\MeasurementFamily;

class MeasurementFamilySeeder extends Seeder
{
    public function run()
    {
        /*
        |--------------------------------------------------------------------------
        | LENGTH
        |--------------------------------------------------------------------------
        */

        MeasurementFamily::updateOrCreate(
            ['code' => 'Length'],
            [
                'name'          => 'Length',
                'labels'        => ['en_US' => 'Length'],
                'standard_unit' => 'METER',
                'symbol'        => 'm',
                'units'         => [
                    ['code' => 'METER', 'labels' => ['en_US' => 'Meter'], 'symbol' => 'm'],
                    ['code' => 'CENTIMETER', 'labels' => ['en_US' => 'Centimeter'], 'symbol' => 'cm'],
                    ['code' => 'MICROMATER', 'labels' => ['en_US' => 'Micrometer'], 'symbol' => 'um'],
                    ['code' => 'NAUTICAL MILE', 'labels' => ['en_US' => 'Nautical mile'], 'symbol' => 'nm'],
                    ['code' => 'MILLIMETER', 'labels' => ['en_US' => 'Millimeter'], 'symbol' => 'mm'],
                    ['code' => 'DECIMETER', 'labels' => ['en_US' => 'Decimeter'], 'symbol' => 'dm'],
                    ['code' => 'DEKAMETER', 'labels' => ['en_US' => 'Dekameter'], 'symbol' => 'dam'],
                    ['code' => 'HECTOMETER', 'labels' => ['en_US' => 'Hectometer'], 'symbol' => 'hm'],
                    ['code' => 'KILOMETER', 'labels' => ['en_US' => 'Kilometer'], 'symbol' => 'km'],
                    ['code' => 'MIL', 'labels' => ['en_US' => 'Mil'], 'symbol' => 'mil'],
                    ['code' => 'INCH', 'labels' => ['en_US' => 'Inch'], 'symbol' => 'cm'],
                    ['code' => 'FEET', 'labels' => ['en_US' => 'Feet'], 'symbol' => 'ft'],
                    ['code' => 'YARD', 'labels' => ['en_US' => 'Yard'], 'symbol' => 'yd'],
                    ['code' => 'CHAIN', 'labels' => ['en_US' => 'Chain'], 'symbol' => 'ch'],
                    ['code' => 'FURLONG', 'labels' => ['en_US' => 'Furlong'], 'symbol' => 'fur'],
                    ['code' => 'MILI', 'labels' => ['en_US' => 'Mili'], 'symbol' => 'mi'],
                ],
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | AREA
        |--------------------------------------------------------------------------
        */

        MeasurementFamily::updateOrCreate(
            ['code' => 'Area'],
            [
                'name'          => 'Area',
                'labels'        => ['en_US' => 'Area'],
                'standard_unit' => 'SQUARE_METER',
                'symbol'        => 'm²',
                'units'         => [
                    ['code' => 'SQUARE_METER', 'labels' => ['en_US' => 'square Meter'], 'symbol' => 'm²'],
                    ['code' => 'SQUARE_CENTIMETER', 'labels' => ['en_US' => 'square centimeter'], 'symbol' => 'cm²'],
                    ['code' => 'SQUARE_MILLIMETER', 'labels' => ['en_US' => 'square millimeter'], 'symbol' => 'mm²'],
                    ['code' => 'SQUARE_DECIMETER', 'labels' => ['en_US' => 'square deciimeter'], 'symbol' => 'dm²'],
                    ['code' => 'SQUARE_FEET', 'labels' => ['en_US' => 'square feet'], 'symbol' => 'ft²'],
                    ['code' => 'SQUARE_YARD', 'labels' => ['en_US' => 'square yard'], 'symbol' => 'yd²'],
                    ['code' => 'HECTARE', 'labels' => ['en_US' => 'hectare'], 'symbol' => 'ha'],
                    ['code' => 'CENTRIARE', 'labels' => ['en_US' => 'centriare'], 'symbol' => 'ca'],
                    ['code' => 'SQUARE_DEKAMETER', 'labels' => ['en_US' => 'square dekameter'], 'symbol' => 'dam²'],
                    ['code' => 'ARE', 'labels' => ['en_US' => 'are'], 'symbol' => 'a'],
                    ['code' => 'SQUARE_HECTOMETER', 'labels' => ['en_US' => 'square hectometer'], 'symbol' => 'hm²'],
                    ['code' => 'SQUARE_KILOMETER', 'labels' => ['en_US' => 'square kilometer'], 'symbol' => 'km²'],
                    ['code' => 'SQUARE_MIL', 'labels' => ['en_US' => 'square mil'], 'symbol' => 'km²'],
                    ['code' => 'SQUARE_INCH', 'labels' => ['en_US' => 'square inch'], 'symbol' => 'in²'],
                    ['code' => 'SQUARE_FOOT', 'labels' => ['en_US' => 'square foot'], 'symbol' => 'ft²'],
                    ['code' => 'ARPENT', 'labels' => ['en_US' => 'arpent'], 'symbol' => 'arpent'],
                    ['code' => 'ACRE', 'labels' => ['en_US' => 'Acre'], 'symbol' => 'A'],
                    ['code' => 'SQUARE_furlog', 'labels' => ['en_US' => 'Square furlog'], 'symbol' => 'fur²'],
                    ['code' => 'SQUARE_mile', 'labels' => ['en_US' => 'square mile'], 'symbol' => 'mi²'],
                ],
            ]
        );

         /*
        |--------------------------------------------------------------------------
        | WEIGHT / MASS
        |--------------------------------------------------------------------------
        */

        MeasurementFamily::updateOrCreate(
            ['code' => 'Weight'],
            [
                'name'          => 'Weight',
                'labels'        => ['en_US' => 'Weight'],
                'standard_unit' => 'KILOGRAM',
                'symbol'        => 'kg',
                'units'         => [
                    ['code' => 'MILLIGRAM', 'labels' => ['en_US' => 'Milligram'], 'symbol' => 'mg'],
                    ['code' => 'GRAM', 'labels' => ['en_US' => 'Gram'], 'symbol' => 'g'],
                    ['code' => 'KILOGRAM', 'labels' => ['en_US' => 'Kilogram'], 'symbol' => 'kg'],
                    ['code' => 'TONNE', 'labels' => ['en_US' => 'Tonne'], 'symbol' => 't'],
                    ['code' => 'MICROGRAM', 'labels' => ['en_US' => 'microgram'], 'symbol' => 'μg'],
                    ['code' => 'TON', 'labels' => ['en_US' => 'ton'], 'symbol' => 't'],
                    ['code' => 'GRAIN', 'labels' => ['en_US' => 'grain'], 'symbol' => 'gr'],
                    ['code' => 'DENIER', 'labels' => ['en_US' => 'denier'], 'symbol' => 'denier'],
                    ['code' => 'ONCE', 'labels' => ['en_US' => 'once'], 'symbol' => 'once'],
                    ['code' => 'Marc', 'labels' => ['en_US' => 'marc'], 'symbol' => 'marc'],
                    ['code' => 'LIVRE', 'labels' => ['en_US' => 'livre'], 'symbol' => 'livre'],
                    ['code' => 'OUNCE', 'labels' => ['en_US' => 'ounce'], 'symbol' => 'μg'],
                    ['code' => 'POUND', 'labels' => ['en_US' => 'pound'], 'symbol' => 'lb'],
                ],
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | ANGLE
        |--------------------------------------------------------------------------
        */

        MeasurementFamily::updateOrCreate(
            ['code' => 'Angle'],
            [
                'name'          => 'Angle',
                'labels'        => ['en_US' => 'Angle'],
                'standard_unit' => 'Radian',
                'symbol'        => 'A',
                'units'         => [
                    ['code' => 'RADIAN', 'labels' => ['en_US' => 'radian'], 'symbol' => 'rad'],
                    ['code' => 'MILLIRADIAN', 'labels' => ['en_US' => 'milliradian'], 'symbol' => 'mrad'],
                    ['code' => 'MICRORADIAN', 'labels' => ['en_US' => 'microradian'], 'symbol' => 'µrad'],
                    ['code' => 'DEGREE', 'labels' => ['en_US' => 'degree'], 'symbol' => '°'],
                    ['code' => 'MINUTE', 'labels' => ['en_US' => 'minute'], 'symbol' => 'M'],
                    ['code' => 'SECOND', 'labels' => ['en_US' => 'second'], 'symbol' => '"'],
                    ['code' => 'GON', 'labels' => ['en_US' => 'gon'], 'symbol' => 'gon'],
                    ['code' => 'MIL', 'labels' => ['en_US' => 'mil'], 'symbol' => 'mil'],
                    ['code' => 'REVOLUTION', 'labels' => ['en_US' => 'revolutin'], 'symbol' => 'rev'],
                ],
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | BINARY
        |--------------------------------------------------------------------------
        */

        MeasurementFamily::updateOrCreate(
            ['code' => 'Binary'],
            [
                'name'          => 'Binary',
                'labels'        => ['en_US' => 'Binary'],
                'standard_unit' => 'Byte',
                'symbol'        => 'by',
                'units'         => [
                    ['code' => 'BYTE', 'labels' => ['en_US' => 'byte'], 'symbol' => 'B'],
                    ['code' => 'CHAR', 'labels' => ['en_US' => 'char'], 'symbol' => 'char'],
                    ['code' => 'KILOBIT', 'labels' => ['en_US' => 'kilobit'], 'symbol' => 'kbit'],
                    ['code' => 'MEGABIT', 'labels' => ['en_US' => 'megabit'], 'symbol' => 'mbit'],
                    ['code' => 'GIBABIT', 'labels' => ['en_US' => 'gibabit'], 'symbol' => 'b'],
                    ['code' => 'BIT', 'labels' => ['en_US' => 'bit'], 'symbol' => '"'],
                    ['code' => 'KILOBYTE', 'labels' => ['en_US' => 'kilobyte'], 'symbol' => 'kb'],
                    ['code' => 'MAGABYTE', 'labels' => ['en_US' => 'magabyte'], 'symbol' => 'mb'],
                    ['code' => 'GIBABYTE', 'labels' => ['en_US' => 'gibabyte'], 'symbol' => 'gb'],
                    ['code' => 'TERABYTE', 'labels' => ['en_US' => 'terabyte'], 'symbol' => 'tb'],
                ],
            ]
        );

         /*
        |--------------------------------------------------------------------------
        | Brightness
        |--------------------------------------------------------------------------
        */

        MeasurementFamily::updateOrCreate(
            ['code' => 'Brightness'],
            [
                'name'          => 'Brightness',
                'labels'        => ['en_US' => 'Brightness'],
                'standard_unit' => 'LUMIN',
                'symbol'        => 'B',
                'units'         => [
                    ['code' => 'LUMIN', 'labels' => ['en_US' => 'Lumin'], 'symbol' => 'lm'],
                    ['code' => 'NIT', 'labels' => ['en_US' => 'Nit'], 'symbol' => 'nits'],
                ],
            ]
        );

    }
}
