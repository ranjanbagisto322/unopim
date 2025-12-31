<?php

namespace Webkul\Measurement\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\HistoryControl\Interfaces\PresentableHistoryInterface;
use Webkul\HistoryControl\Presenters\BooleanPresenter;
use Webkul\HistoryControl\Traits\HistoryTrait;

class MeasurementFamily extends Model
{
    protected $fillable = [
        'code',
        'name',
        'labels',
        'standard_unit',
        'units',
        'symbol',
    ];

    protected $casts = [
        'units'     => 'array',
        'labels'    => 'array',
    ];

    public function getUnitsArrayAttribute()
    {
        return $this->units ?? [];
    }
}
