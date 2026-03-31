<?php

namespace Webkul\Measurement\Database\Seeders;

use Illuminate\Database\Seeder;
use Webkul\Measurement\Models\MeasurementFamily;

class MeasurementFamilySeeder extends Seeder
{
    public function run($parameters = [])
    {
        $parameters     = $parameters ?? [];
        $defaultLocale  = $parameters['default_locale'] ?? config('app.locale');
        $locales        = $parameters['allowed_locales'] ?? [$defaultLocale];

        $makeLabels = function ($value) use ($locales) {
            $labels = [];

            foreach ($locales as $locale) {
                $labels[$locale] = ucfirst($value);
            }

            return $labels;
        };

        /*
        |--------------------------------------------------------------------------
        | 1. LENGTH
        |--------------------------------------------------------------------------
        */
        MeasurementFamily::updateOrCreate(
            ['code' => 'length'],
            [
                'name'          => 'Length',
                'labels'        => $makeLabels('length'),
                'standard_unit' => 'meter',
                'symbol'        => 'm',
                'units'         => [
                    ['code' => 'meter',       'labels' => $makeLabels('meter'),       'symbol' => 'm'],
                    ['code' => 'centimeter',  'labels' => $makeLabels('centimeter'),  'symbol' => 'cm'],
                    ['code' => 'millimeter',  'labels' => $makeLabels('millimeter'),  'symbol' => 'mm'],
                    ['code' => 'kilometer',   'labels' => $makeLabels('kilometer'),   'symbol' => 'km'],
                    ['code' => 'inch',        'labels' => $makeLabels('inch'),        'symbol' => 'in'],
                    ['code' => 'foot',        'labels' => $makeLabels('foot'),        'symbol' => 'ft'],
                    ['code' => 'yard',        'labels' => $makeLabels('yard'),        'symbol' => 'yd'],
                    ['code' => 'mile',        'labels' => $makeLabels('mile'),        'symbol' => 'mi'],
                ],
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | 2. AREA
        |--------------------------------------------------------------------------
        */
        MeasurementFamily::updateOrCreate(
            ['code' => 'area'],
            [
                'name'          => 'Area',
                'labels'        => $makeLabels('area'),
                'standard_unit' => 'square_meter',
                'symbol'        => 'm²',
                'units'         => [
                    ['code' => 'square_meter',      'labels' => $makeLabels('square meter'),      'symbol' => 'm²'],
                    ['code' => 'square_centimeter', 'labels' => $makeLabels('square centimeter'), 'symbol' => 'cm²'],
                    ['code' => 'square_kilometer',  'labels' => $makeLabels('square kilometer'),  'symbol' => 'km²'],
                    ['code' => 'square_foot',       'labels' => $makeLabels('square foot'),       'symbol' => 'ft²'],
                    ['code' => 'square_inch',       'labels' => $makeLabels('square inch'),       'symbol' => 'in²'],
                    ['code' => 'square_yard',       'labels' => $makeLabels('square yard'),       'symbol' => 'yd²'],
                    ['code' => 'hectare',           'labels' => $makeLabels('hectare'),           'symbol' => 'ha'],
                    ['code' => 'acre',              'labels' => $makeLabels('acre'),              'symbol' => 'ac'],
                ],
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | 3. WEIGHT
        |--------------------------------------------------------------------------
        */
        MeasurementFamily::updateOrCreate(
            ['code' => 'weight'],
            [
                'name'          => 'Weight',
                'labels'        => $makeLabels('weight'),
                'standard_unit' => 'kilogram',
                'symbol'        => 'kg',
                'units'         => [
                    ['code' => 'milligram', 'labels' => $makeLabels('milligram'), 'symbol' => 'mg'],
                    ['code' => 'gram',      'labels' => $makeLabels('gram'),      'symbol' => 'g'],
                    ['code' => 'kilogram',  'labels' => $makeLabels('kilogram'),  'symbol' => 'kg'],
                    ['code' => 'tonne',     'labels' => $makeLabels('tonne'),     'symbol' => 't'],
                    ['code' => 'pound',     'labels' => $makeLabels('pound'),     'symbol' => 'lb'],
                    ['code' => 'ounce',     'labels' => $makeLabels('ounce'),     'symbol' => 'oz'],
                    ['code' => 'stone',     'labels' => $makeLabels('stone'),     'symbol' => 'st'],
                ],
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | 4. VOLUME
        |--------------------------------------------------------------------------
        */
        MeasurementFamily::updateOrCreate(
            ['code' => 'volume'],
            [
                'name'          => 'Volume',
                'labels'        => $makeLabels('volume'),
                'standard_unit' => 'liter',
                'symbol'        => 'L',
                'units'         => [
                    ['code' => 'milliliter',  'labels' => $makeLabels('milliliter'),  'symbol' => 'ml'],
                    ['code' => 'centiliter',  'labels' => $makeLabels('centiliter'),  'symbol' => 'cl'],
                    ['code' => 'liter',       'labels' => $makeLabels('liter'),       'symbol' => 'L'],
                    ['code' => 'cubic_meter', 'labels' => $makeLabels('cubic meter'), 'symbol' => 'm³'],
                    ['code' => 'cubic_inch',  'labels' => $makeLabels('cubic inch'),  'symbol' => 'in³'],
                    ['code' => 'cubic_foot',  'labels' => $makeLabels('cubic foot'),  'symbol' => 'ft³'],
                    ['code' => 'gallon',      'labels' => $makeLabels('gallon'),      'symbol' => 'gal'],
                    ['code' => 'fluid_ounce', 'labels' => $makeLabels('fluid ounce'), 'symbol' => 'fl oz'],
                    ['code' => 'pint',        'labels' => $makeLabels('pint'),        'symbol' => 'pt'],
                    ['code' => 'quart',       'labels' => $makeLabels('quart'),       'symbol' => 'qt'],
                ],
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | 5. TEMPERATURE
        |--------------------------------------------------------------------------
        */
        MeasurementFamily::updateOrCreate(
            ['code' => 'temperature'],
            [
                'name'          => 'Temperature',
                'labels'        => $makeLabels('temperature'),
                'standard_unit' => 'celsius',
                'symbol'        => '°C',
                'units'         => [
                    ['code' => 'celsius',    'labels' => $makeLabels('celsius'),    'symbol' => '°C'],
                    ['code' => 'fahrenheit', 'labels' => $makeLabels('fahrenheit'), 'symbol' => '°F'],
                    ['code' => 'kelvin',     'labels' => $makeLabels('kelvin'),     'symbol' => 'K'],
                ],
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | 6. SPEED
        |--------------------------------------------------------------------------
        */
        MeasurementFamily::updateOrCreate(
            ['code' => 'speed'],
            [
                'name'          => 'Speed',
                'labels'        => $makeLabels('speed'),
                'standard_unit' => 'meter_per_second',
                'symbol'        => 'm/s',
                'units'         => [
                    ['code' => 'meter_per_second',     'labels' => $makeLabels('meter per second'),     'symbol' => 'm/s'],
                    ['code' => 'kilometer_per_hour',   'labels' => $makeLabels('kilometer per hour'),   'symbol' => 'km/h'],
                    ['code' => 'mile_per_hour',        'labels' => $makeLabels('mile per hour'),        'symbol' => 'mph'],
                    ['code' => 'knot',                 'labels' => $makeLabels('knot'),                 'symbol' => 'kn'],
                    ['code' => 'foot_per_second',      'labels' => $makeLabels('foot per second'),      'symbol' => 'ft/s'],
                ],
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | 7. TIME
        |--------------------------------------------------------------------------
        */
        MeasurementFamily::updateOrCreate(
            ['code' => 'time'],
            [
                'name'          => 'Time',
                'labels'        => $makeLabels('time'),
                'standard_unit' => 'second',
                'symbol'        => 's',
                'units'         => [
                    ['code' => 'millisecond', 'labels' => $makeLabels('millisecond'), 'symbol' => 'ms'],
                    ['code' => 'second',      'labels' => $makeLabels('second'),      'symbol' => 's'],
                    ['code' => 'minute',      'labels' => $makeLabels('minute'),      'symbol' => 'min'],
                    ['code' => 'hour',        'labels' => $makeLabels('hour'),        'symbol' => 'h'],
                    ['code' => 'day',         'labels' => $makeLabels('day'),         'symbol' => 'd'],
                    ['code' => 'week',        'labels' => $makeLabels('week'),        'symbol' => 'wk'],
                    ['code' => 'month',       'labels' => $makeLabels('month'),       'symbol' => 'mo'],
                    ['code' => 'year',        'labels' => $makeLabels('year'),        'symbol' => 'yr'],
                ],
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | 8. PRESSURE
        |--------------------------------------------------------------------------
        */
        MeasurementFamily::updateOrCreate(
            ['code' => 'pressure'],
            [
                'name'          => 'Pressure',
                'labels'        => $makeLabels('pressure'),
                'standard_unit' => 'pascal',
                'symbol'        => 'Pa',
                'units'         => [
                    ['code' => 'pascal',      'labels' => $makeLabels('pascal'),      'symbol' => 'Pa'],
                    ['code' => 'kilopascal',  'labels' => $makeLabels('kilopascal'),  'symbol' => 'kPa'],
                    ['code' => 'megapascal',  'labels' => $makeLabels('megapascal'),  'symbol' => 'MPa'],
                    ['code' => 'bar',         'labels' => $makeLabels('bar'),         'symbol' => 'bar'],
                    ['code' => 'millibar',    'labels' => $makeLabels('millibar'),    'symbol' => 'mbar'],
                    ['code' => 'atmosphere',  'labels' => $makeLabels('atmosphere'),  'symbol' => 'atm'],
                    ['code' => 'psi',         'labels' => $makeLabels('psi'),         'symbol' => 'psi'],
                    ['code' => 'torr',        'labels' => $makeLabels('torr'),        'symbol' => 'Torr'],
                ],
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | 9. ENERGY
        |--------------------------------------------------------------------------
        */
        MeasurementFamily::updateOrCreate(
            ['code' => 'energy'],
            [
                'name'          => 'Energy',
                'labels'        => $makeLabels('energy'),
                'standard_unit' => 'joule',
                'symbol'        => 'J',
                'units'         => [
                    ['code' => 'joule',           'labels' => $makeLabels('joule'),           'symbol' => 'J'],
                    ['code' => 'kilojoule',       'labels' => $makeLabels('kilojoule'),       'symbol' => 'kJ'],
                    ['code' => 'calorie',         'labels' => $makeLabels('calorie'),         'symbol' => 'cal'],
                    ['code' => 'kilocalorie',     'labels' => $makeLabels('kilocalorie'),     'symbol' => 'kcal'],
                    ['code' => 'watt_hour',       'labels' => $makeLabels('watt hour'),       'symbol' => 'Wh'],
                    ['code' => 'kilowatt_hour',   'labels' => $makeLabels('kilowatt hour'),   'symbol' => 'kWh'],
                    ['code' => 'electronvolt',    'labels' => $makeLabels('electronvolt'),    'symbol' => 'eV'],
                    ['code' => 'british_thermal_unit', 'labels' => $makeLabels('british thermal unit'), 'symbol' => 'BTU'],
                ],
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | 10. POWER
        |--------------------------------------------------------------------------
        */
        MeasurementFamily::updateOrCreate(
            ['code' => 'power'],
            [
                'name'          => 'Power',
                'labels'        => $makeLabels('power'),
                'standard_unit' => 'watt',
                'symbol'        => 'W',
                'units'         => [
                    ['code' => 'milliwatt',  'labels' => $makeLabels('milliwatt'),  'symbol' => 'mW'],
                    ['code' => 'watt',       'labels' => $makeLabels('watt'),       'symbol' => 'W'],
                    ['code' => 'kilowatt',   'labels' => $makeLabels('kilowatt'),   'symbol' => 'kW'],
                    ['code' => 'megawatt',   'labels' => $makeLabels('megawatt'),   'symbol' => 'MW'],
                    ['code' => 'gigawatt',   'labels' => $makeLabels('gigawatt'),   'symbol' => 'GW'],
                    ['code' => 'horsepower', 'labels' => $makeLabels('horsepower'), 'symbol' => 'hp'],
                ],
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | 11. FREQUENCY
        |--------------------------------------------------------------------------
        */
        MeasurementFamily::updateOrCreate(
            ['code' => 'frequency'],
            [
                'name'          => 'Frequency',
                'labels'        => $makeLabels('frequency'),
                'standard_unit' => 'hertz',
                'symbol'        => 'Hz',
                'units'         => [
                    ['code' => 'hertz',     'labels' => $makeLabels('hertz'),     'symbol' => 'Hz'],
                    ['code' => 'kilohertz', 'labels' => $makeLabels('kilohertz'), 'symbol' => 'kHz'],
                    ['code' => 'megahertz', 'labels' => $makeLabels('megahertz'), 'symbol' => 'MHz'],
                    ['code' => 'gigahertz', 'labels' => $makeLabels('gigahertz'), 'symbol' => 'GHz'],
                ],
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | 12. DIGITAL STORAGE
        |--------------------------------------------------------------------------
        */
        MeasurementFamily::updateOrCreate(
            ['code' => 'digital_storage'],
            [
                'name'          => 'Digital Storage',
                'labels'        => $makeLabels('digital storage'),
                'standard_unit' => 'byte',
                'symbol'        => 'B',
                'units'         => [
                    ['code' => 'bit',      'labels' => $makeLabels('bit'),      'symbol' => 'b'],
                    ['code' => 'byte',     'labels' => $makeLabels('byte'),     'symbol' => 'B'],
                    ['code' => 'kilobyte', 'labels' => $makeLabels('kilobyte'), 'symbol' => 'KB'],
                    ['code' => 'megabyte', 'labels' => $makeLabels('megabyte'), 'symbol' => 'MB'],
                    ['code' => 'gigabyte', 'labels' => $makeLabels('gigabyte'), 'symbol' => 'GB'],
                    ['code' => 'terabyte', 'labels' => $makeLabels('terabyte'), 'symbol' => 'TB'],
                    ['code' => 'petabyte', 'labels' => $makeLabels('petabyte'), 'symbol' => 'PB'],
                ],
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | 13. ANGLE
        |--------------------------------------------------------------------------
        */
        MeasurementFamily::updateOrCreate(
            ['code' => 'angle'],
            [
                'name'          => 'Angle',
                'labels'        => $makeLabels('angle'),
                'standard_unit' => 'degree',
                'symbol'        => '°',
                'units'         => [
                    ['code' => 'degree',     'labels' => $makeLabels('degree'),     'symbol' => '°'],
                    ['code' => 'radian',     'labels' => $makeLabels('radian'),     'symbol' => 'rad'],
                    ['code' => 'gradian',    'labels' => $makeLabels('gradian'),    'symbol' => 'grad'],
                    ['code' => 'arcminute',  'labels' => $makeLabels('arcminute'),  'symbol' => '\''],
                    ['code' => 'arcsecond',  'labels' => $makeLabels('arcsecond'),  'symbol' => '"'],
                ],
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | 14. ELECTRIC CURRENT
        |--------------------------------------------------------------------------
        */
        MeasurementFamily::updateOrCreate(
            ['code' => 'electric_current'],
            [
                'name'          => 'Electric Current',
                'labels'        => $makeLabels('electric current'),
                'standard_unit' => 'ampere',
                'symbol'        => 'A',
                'units'         => [
                    ['code' => 'microampere', 'labels' => $makeLabels('microampere'), 'symbol' => 'µA'],
                    ['code' => 'milliampere', 'labels' => $makeLabels('milliampere'), 'symbol' => 'mA'],
                    ['code' => 'ampere',      'labels' => $makeLabels('ampere'),      'symbol' => 'A'],
                    ['code' => 'kiloampere',  'labels' => $makeLabels('kiloampere'),  'symbol' => 'kA'],
                ],
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | 15. VOLTAGE
        |--------------------------------------------------------------------------
        */
        MeasurementFamily::updateOrCreate(
            ['code' => 'voltage'],
            [
                'name'          => 'Voltage',
                'labels'        => $makeLabels('voltage'),
                'standard_unit' => 'volt',
                'symbol'        => 'V',
                'units'         => [
                    ['code' => 'microvolt',  'labels' => $makeLabels('microvolt'),  'symbol' => 'µV'],
                    ['code' => 'millivolt',  'labels' => $makeLabels('millivolt'),  'symbol' => 'mV'],
                    ['code' => 'volt',       'labels' => $makeLabels('volt'),       'symbol' => 'V'],
                    ['code' => 'kilovolt',   'labels' => $makeLabels('kilovolt'),   'symbol' => 'kV'],
                    ['code' => 'megavolt',   'labels' => $makeLabels('megavolt'),   'symbol' => 'MV'],
                ],
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | 16. RESISTANCE
        |--------------------------------------------------------------------------
        */
        MeasurementFamily::updateOrCreate(
            ['code' => 'resistance'],
            [
                'name'          => 'Resistance',
                'labels'        => $makeLabels('resistance'),
                'standard_unit' => 'ohm',
                'symbol'        => 'Ω',
                'units'         => [
                    ['code' => 'milliohm', 'labels' => $makeLabels('milliohm'), 'symbol' => 'mΩ'],
                    ['code' => 'ohm',      'labels' => $makeLabels('ohm'),      'symbol' => 'Ω'],
                    ['code' => 'kilohm',   'labels' => $makeLabels('kilohm'),   'symbol' => 'kΩ'],
                    ['code' => 'megaohm',  'labels' => $makeLabels('megaohm'),  'symbol' => 'MΩ'],
                ],
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | 17. FORCE
        |--------------------------------------------------------------------------
        */
        MeasurementFamily::updateOrCreate(
            ['code' => 'force'],
            [
                'name'          => 'Force',
                'labels'        => $makeLabels('force'),
                'standard_unit' => 'newton',
                'symbol'        => 'N',
                'units'         => [
                    ['code' => 'newton',      'labels' => $makeLabels('newton'),      'symbol' => 'N'],
                    ['code' => 'kilonewton',  'labels' => $makeLabels('kilonewton'),  'symbol' => 'kN'],
                    ['code' => 'meganewton',  'labels' => $makeLabels('meganewton'),  'symbol' => 'MN'],
                    ['code' => 'dyne',        'labels' => $makeLabels('dyne'),        'symbol' => 'dyn'],
                    ['code' => 'pound_force', 'labels' => $makeLabels('pound force'), 'symbol' => 'lbf'],
                    ['code' => 'kilogram_force', 'labels' => $makeLabels('kilogram force'), 'symbol' => 'kgf'],
                ],
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | 18. DENSITY
        |--------------------------------------------------------------------------
        */
        MeasurementFamily::updateOrCreate(
            ['code' => 'density'],
            [
                'name'          => 'Density',
                'labels'        => $makeLabels('density'),
                'standard_unit' => 'kilogram_per_cubic_meter',
                'symbol'        => 'kg/m³',
                'units'         => [
                    ['code' => 'kilogram_per_cubic_meter', 'labels' => $makeLabels('kilogram per cubic meter'), 'symbol' => 'kg/m³'],
                    ['code' => 'gram_per_cubic_centimeter', 'labels' => $makeLabels('gram per cubic centimeter'), 'symbol' => 'g/cm³'],
                    ['code' => 'gram_per_liter',           'labels' => $makeLabels('gram per liter'),           'symbol' => 'g/L'],
                    ['code' => 'kilogram_per_liter',       'labels' => $makeLabels('kilogram per liter'),       'symbol' => 'kg/L'],
                    ['code' => 'pound_per_cubic_foot',     'labels' => $makeLabels('pound per cubic foot'),     'symbol' => 'lb/ft³'],
                ],
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | 19. LUMINANCE / ILLUMINANCE
        |--------------------------------------------------------------------------
        */
        MeasurementFamily::updateOrCreate(
            ['code' => 'illuminance'],
            [
                'name'          => 'Illuminance',
                'labels'        => $makeLabels('illuminance'),
                'standard_unit' => 'lux',
                'symbol'        => 'lx',
                'units'         => [
                    ['code' => 'lux',       'labels' => $makeLabels('lux'),       'symbol' => 'lx'],
                    ['code' => 'footcandle', 'labels' => $makeLabels('footcandle'), 'symbol' => 'fc'],
                    ['code' => 'phot',      'labels' => $makeLabels('phot'),      'symbol' => 'ph'],
                ],
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | 20. RADIOACTIVITY
        |--------------------------------------------------------------------------
        */
        MeasurementFamily::updateOrCreate(
            ['code' => 'radioactivity'],
            [
                'name'          => 'Radioactivity',
                'labels'        => $makeLabels('radioactivity'),
                'standard_unit' => 'becquerel',
                'symbol'        => 'Bq',
                'units'         => [
                    ['code' => 'becquerel',  'labels' => $makeLabels('becquerel'),  'symbol' => 'Bq'],
                    ['code' => 'kilobecquerel', 'labels' => $makeLabels('kilobecquerel'), 'symbol' => 'kBq'],
                    ['code' => 'megabecquerel', 'labels' => $makeLabels('megabecquerel'), 'symbol' => 'MBq'],
                    ['code' => 'curie',      'labels' => $makeLabels('curie'),      'symbol' => 'Ci'],
                    ['code' => 'millicurie', 'labels' => $makeLabels('millicurie'), 'symbol' => 'mCi'],
                ],
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | 21. FUEL CONSUMPTION
        |--------------------------------------------------------------------------
        */
        MeasurementFamily::updateOrCreate(
            ['code' => 'fuel_consumption'],
            [
                'name'          => 'Fuel Consumption',
                'labels'        => $makeLabels('fuel consumption'),
                'standard_unit' => 'liter_per_100km',
                'symbol'        => 'L/100km',
                'units'         => [
                    ['code' => 'liter_per_100km',      'labels' => $makeLabels('liter per 100km'),      'symbol' => 'L/100km'],
                    ['code' => 'kilometer_per_liter',  'labels' => $makeLabels('kilometer per liter'),  'symbol' => 'km/L'],
                    ['code' => 'mile_per_gallon',      'labels' => $makeLabels('mile per gallon'),      'symbol' => 'mpg'],
                    ['code' => 'mile_per_liter',       'labels' => $makeLabels('mile per liter'),       'symbol' => 'mi/L'],
                ],
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | 22. CONCENTRATION
        |--------------------------------------------------------------------------
        */
        MeasurementFamily::updateOrCreate(
            ['code' => 'concentration'],
            [
                'name'          => 'Concentration',
                'labels'        => $makeLabels('concentration'),
                'standard_unit' => 'mole_per_liter',
                'symbol'        => 'mol/L',
                'units'         => [
                    ['code' => 'mole_per_liter',        'labels' => $makeLabels('mole per liter'),        'symbol' => 'mol/L'],
                    ['code' => 'millimole_per_liter',   'labels' => $makeLabels('millimole per liter'),   'symbol' => 'mmol/L'],
                    ['code' => 'microgram_per_liter',   'labels' => $makeLabels('microgram per liter'),   'symbol' => 'µg/L'],
                    ['code' => 'milligram_per_liter',   'labels' => $makeLabels('milligram per liter'),   'symbol' => 'mg/L'],
                    ['code' => 'gram_per_liter_conc',   'labels' => $makeLabels('gram per liter'),        'symbol' => 'g/L'],
                    ['code' => 'parts_per_million',     'labels' => $makeLabels('parts per million'),     'symbol' => 'ppm'],
                    ['code' => 'parts_per_billion',     'labels' => $makeLabels('parts per billion'),     'symbol' => 'ppb'],
                ],
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | 23. TORQUE
        |--------------------------------------------------------------------------
        */
        MeasurementFamily::updateOrCreate(
            ['code' => 'torque'],
            [
                'name'          => 'Torque',
                'labels'        => $makeLabels('torque'),
                'standard_unit' => 'newton_meter',
                'symbol'        => 'N·m',
                'units'         => [
                    ['code' => 'newton_meter',         'labels' => $makeLabels('newton meter'),         'symbol' => 'N·m'],
                    ['code' => 'newton_centimeter',    'labels' => $makeLabels('newton centimeter'),    'symbol' => 'N·cm'],
                    ['code' => 'kilonewton_meter',     'labels' => $makeLabels('kilonewton meter'),     'symbol' => 'kN·m'],
                    ['code' => 'pound_foot',           'labels' => $makeLabels('pound foot'),           'symbol' => 'lb·ft'],
                    ['code' => 'pound_inch',           'labels' => $makeLabels('pound inch'),           'symbol' => 'lb·in'],
                    ['code' => 'kilogram_force_meter', 'labels' => $makeLabels('kilogram force meter'), 'symbol' => 'kgf·m'],
                ],
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | 24. FLOW RATE
        |--------------------------------------------------------------------------
        */
        MeasurementFamily::updateOrCreate(
            ['code' => 'flow_rate'],
            [
                'name'          => 'Flow Rate',
                'labels'        => $makeLabels('flow rate'),
                'standard_unit' => 'cubic_meter_per_second',
                'symbol'        => 'm³/s',
                'units'         => [
                    ['code' => 'cubic_meter_per_second',  'labels' => $makeLabels('cubic meter per second'),  'symbol' => 'm³/s'],
                    ['code' => 'liter_per_second',        'labels' => $makeLabels('liter per second'),        'symbol' => 'L/s'],
                    ['code' => 'liter_per_minute',        'labels' => $makeLabels('liter per minute'),        'symbol' => 'L/min'],
                    ['code' => 'liter_per_hour',          'labels' => $makeLabels('liter per hour'),          'symbol' => 'L/h'],
                    ['code' => 'cubic_foot_per_minute',   'labels' => $makeLabels('cubic foot per minute'),   'symbol' => 'ft³/min'],
                    ['code' => 'gallon_per_minute',       'labels' => $makeLabels('gallon per minute'),       'symbol' => 'gal/min'],
                ],
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | 25. LUMINOUS INTENSITY
        |--------------------------------------------------------------------------
        */
        MeasurementFamily::updateOrCreate(
            ['code' => 'luminous_intensity'],
            [
                'name'          => 'Luminous Intensity',
                'labels'        => $makeLabels('luminous intensity'),
                'standard_unit' => 'candela',
                'symbol'        => 'cd',
                'units'         => [
                    ['code' => 'millicandela', 'labels' => $makeLabels('millicandela'), 'symbol' => 'mcd'],
                    ['code' => 'candela',      'labels' => $makeLabels('candela'),      'symbol' => 'cd'],
                    ['code' => 'kilocandela',  'labels' => $makeLabels('kilocandela'),  'symbol' => 'kcd'],
                    ['code' => 'lumen',        'labels' => $makeLabels('lumen'),        'symbol' => 'lm'],
                ],
            ]
        );
    }
}