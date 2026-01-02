<?php

namespace Webkul\Measurement\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Webkul\Measurement\Database\Factories\MeasurementFamilyFactory;

class MeasurementFamily extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'labels',
        'standard_unit',
        'units',
        'symbol',
    ];

    protected $casts = [
        'units'  => 'array',
        'labels' => 'array',
    ];

    protected static function newFactory()
    {
        return MeasurementFamilyFactory::new();
    }

    public function getUnitsArrayAttribute()
    {
        return $this->units ?? [];
    }
}
