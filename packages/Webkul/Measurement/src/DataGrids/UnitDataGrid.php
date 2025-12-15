<?php

namespace Webkul\Measurement\DataGrids;

use Illuminate\Support\Facades\DB;
use Webkul\DataGrid\DataGrid;

class UnitDataGrid extends DataGrid
{
    protected $primaryColumn = 'code';

    protected $familyId;

    public function setFamilyId($id)
    {
        $this->familyId = $id;
    }

    public function prepareQueryBuilder()
    {

        $family = DB::table('measurement_families')
            ->where('id', $this->familyId)
            ->first();

        $units = json_decode($family->units ?? '[]', true);

        if (empty($units)) {
            $query = DB::table('measurement_families')
                ->select(DB::raw('NULL as code'), DB::raw('NULL as label'), DB::raw('NULL as symbol'))
                ->whereRaw('1 = 0');

            $this->setQueryBuilder($query);

            return $query;
        }

        /**
         * Convert unit JSON array to SQL rows using UNION ALL
         */
        $queryList = [];

        foreach ($units as $unit) {
            $code = $unit['code'] ?? '';
            $label = $unit['labels']['en_US'] ?? '';
            $symbol = $unit['symbol'] ?? '';

            $queryList[] = DB::table(DB::raw(
                "(SELECT 
                    '$code'   AS code,
                    '$label'  AS label,
                    '$symbol' AS symbol
                ) temp"
            ));
        }

        $finalQuery = array_shift($queryList);

        foreach ($queryList as $q) {
            $finalQuery = $finalQuery->unionAll($q);
        }

        $this->setQueryBuilder($finalQuery);

        return $finalQuery;
    }

    public function prepareColumns()
    {
        $this->addColumn([
            'index'      => 'code',
            'label'      => 'Code',
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'label',
            'label'      => 'Label',
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'symbol',
            'label'      => 'Symbol',
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
        ]);
    }

    public function prepareActions()
    {
        // EDIT
        $this->addAction([
            'icon'   => 'icon-edit',
            'title'  => 'Edit',
            'method' => 'GET',
            'url'    => function ($row) {
                return route('admin.measurement.families.units.edit', [
                    'family_id' => $this->familyId,
                    'code'      => $row->code,
                ]);
            },
            'type' => 'script',
        ]);

        // DELETE
        $this->addAction([
            'icon'   => 'icon-delete',
            'title'  => 'Delete',
            'method' => 'DELETE',
            'url'    => function ($row) {
                return route('admin.measurement.families.units.delete', [
                    'family_id' => $this->familyId,
                    'code'      => $row->code,
                ]);
            },
        ]);
    }

    public function prepareMassActions()
    {
        $this->addMassAction([
            'title'  => 'Delete Selected',
            'method' => 'POST',
            'url'    => route('admin.measurement.families.unitmass_delete'),
        ]);
    }
}
