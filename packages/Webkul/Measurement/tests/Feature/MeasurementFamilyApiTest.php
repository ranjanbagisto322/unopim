<?php

use Webkul\User\Models\Admin;
use Webkul\Measurement\Models\MeasurementFamily;
use Illuminate\Testing\Fluent\AssertableJson;

uses(Webkul\Measurement\Tests\MeasurementTestCase::class)
    ->group('measurement', 'api');

beforeEach(function () {
    $this->admin = Admin::factory()->create();
    $this->token = $this->admin->createToken('TestToken')->plainTextToken;
});

function familyWithUnits(array $units = [])
{
    return MeasurementFamily::factory()->create([
        'units' => $units,
    ]);
}

it('should return units index', function () {
    $family = familyWithUnits();

    $this->withHeader('Authorization', "Bearer {$this->token}")
         ->getJson(route('admin.api.measurement-units.index', $family->id))
         ->assertOk()
         ->assertJsonStructure([
             'success',
             'count',
             'data',
         ]);
});



it('should create a measurement family', function () {
    $payload = [
        'code'          => 'length',
        'name'          => 'Length',
        'labels'        => [
            'en_US' => 'Length',
        ],
        'standard_unit' => 'meter',
        'units'         => [
            [
                'code'   => 'meter',
                'labels' => [
                    'en_US' => 'Meter',
                ],
                'symbol' => 'm',
            ],
        ],
        'symbol' => 'm',
    ];

    $this->postJson(route('api.measurement.families.store'), $payload)
        ->assertStatus(200)
        ->assertJson([
            'success' => true,
            'message' => 'Measurement Family saved successfully',
        ]);
});

it('should update a measurement family', function () {
    $family = MeasurementFamily::factory()->create();

    $this->putJson(
        route('api.measurement.families.update', $family->id),
        ['name' => 'Updated Name']
    )
    ->assertStatus(200)
    ->assertJson([
        'success' => true,
        'message' => 'Measurement family updated successfully',
    ]);
});

it('should return 404 if measurement family not found while updating', function () {
    $this->putJson(
        route('api.measurement.families.update', 99999),
        ['name' => 'Test']
    )
    ->assertStatus(404)
    ->assertJson([
        'success' => false,
        'message' => 'Measurement family not found',
    ]);
});

it('should delete a measurement family', function () {
    $family = MeasurementFamily::factory()->create();

    $this->deleteJson(
        route('api.measurement.families.destroy', $family->id)
    )
    ->assertStatus(200)
    ->assertJson([
        'success' => true,
        'message' => 'Measurement family deleted successfully',
    ]);
});
