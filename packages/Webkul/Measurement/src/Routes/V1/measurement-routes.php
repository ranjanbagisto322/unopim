<?php

use Illuminate\Support\Facades\Route;
use Webkul\Measurement\Http\Controllers\Api\MeasurementFamilyApiController;

Route::group([
    'middleware' => [
        'auth:api',
    ],
], function () {
    /** Measurement API Routes */
    Route::controller(MeasurementFamilyApiController::class)->prefix('measurement')->group(function () {
        Route::get('', 'index')->name('admin.api.measurement.index');
        Route::post('', 'store')->name('admin.api.measurement.store');
        Route::put('{id}', 'update')->name('admin.api.measurement.update');
        Route::delete('{id}', 'destroy')->name('admin.api.measurement.delete');
    });

});
