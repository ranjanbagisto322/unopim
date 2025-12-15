<?php

namespace Webkul\Measurement\Models;

use Illuminate\Database\Eloquent\Model;

class MeasurementFamily extends Model
{
    protected $table = 'measurement_families';

    protected $fillable = [
        'code',
        'name',
        'labels',
        'standard_unit',
        'units',
        'symbol',
    ];

    public function getUnitsArrayAttribute()
    {
        if (is_string($this->units)) {
            return json_decode($this->units, true);
        } elseif (is_array($this->units)) {
            return $this->units;
        }

        return [];
    }

    public function getLabelsArrayAttribute()
    {
        if (is_string($this->labels)) {
            return json_decode($this->labels, true);
        } elseif (is_array($this->labels)) {
            return $this->labels;
        }

        return [];
    }
}
