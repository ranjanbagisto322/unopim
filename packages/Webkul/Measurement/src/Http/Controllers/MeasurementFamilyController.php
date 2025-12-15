<?php

namespace Webkul\Measurement\Http\Controllers;

use Illuminate\Http\Request;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Measurement\DataGrids\MeasurementFamilyDataGrid;
use Webkul\Measurement\DataGrids\UnitDataGrid;
use Webkul\Measurement\Repository\MeasurementFamilyRepository;

class MeasurementFamilyController extends Controller
{
    public function __construct(protected MeasurementFamilyRepository $measurementFamilyRepository) {}

    public function index()
    {
        if (request()->ajax()) {
            return app(MeasurementFamilyDataGrid::class)->toJson();
        }

        return view('measurement::admin.families.index');

    }

    public function store(Request $request)
    {
        $request->validate([
            'code'                => 'required|string|max:191',
            'label'               => 'required|string|max:191',
            'standard_unit_code'  => 'required|string|max:191',
            'standard_unit_label' => 'nullable|string|max:191',
            'symbol'              => 'nullable|string|max:50',
        ]);

        $labels = [
            'en_US' => $request->label,
        ];

        $units = [
            [
                'code'   => $request->standard_unit_code,
                'labels' => [
                    'en_US' => $request->standard_unit_label ?: $request->standard_unit_code,
                ],
                'symbol' => $request->symbol,
            ],
        ];

        $data = [
            'code'          => $request->code,
            'name'          => $request->label,
            'labels'        => json_encode($labels),
            'standard_unit' => $request->standard_unit_code,
            'units'         => json_encode($units),
            'symbol'        => $request->symbol,
        ];

        $family = $this->measurementFamilyRepository->create($data);

        return response()->json([
            'data' => [
                'redirect_url' => route('admin.measurement.families.edit', $family->id),
            ],
        ]);
    }

    public function edit($id)
    {
        $family = $this->measurementFamilyRepository->find($id);

        $labels = $family->labels ? json_decode($family->labels, true) : [];

        return view('measurement::admin.families.edit', compact('family', 'labels'));
    }

    public function update(Request $request, $id)
    {
        $family = $this->measurementFamilyRepository->find($id);

        // Validation
        $request->validate([
            'name'     => 'required|string',
            'labels'   => 'nullable|array',
            'labels.*' => 'nullable|string',
        ]);

        $oldLabels = $family->labels ? json_decode($family->labels, true) : [];
        $newLabels = $request->labels ?? [];
        $mergedLabels = array_merge($oldLabels, $newLabels);

        $data = [
            'name'   => $request->name,
            'labels' => json_encode($mergedLabels),
        ];

        $this->measurementFamilyRepository->update($data, $id);

        session()->flash('success', 'Measurement Family updated successfully.');

        return redirect()->route('admin.measurement.families.index');
    }

    public function destroy($id)
    {
        $this->measurementFamilyRepository->delete($id);

        return response()->json(['success' => true]);
    }

    public function massDelete()
    {
        $ids = request()->input('indices');

        if (! $ids || count($ids) == 0) {
            session()->flash('error', 'No items selected.');

            return redirect()->back();
        }

        foreach ($ids as $id) {
            $this->measurementFamilyRepository->delete($id);
        }

        session()->flash('success', 'Selected measurement families deleted successfully.');

        return redirect()->back();
    }

    // units modules all functions
    public function units($id)
    {
        if (request()->ajax()) {

            $grid = app(UnitDataGrid::class);
            $grid->setFamilyId($id);

            return $grid->toJson();
        }

        $family = $this->measurementFamilyRepository->find($id);

        return view('measurement::admin.units.index', compact('family'));
    }

    public function storeUnit($id)
    {
        $family = $this->measurementFamilyRepository->find($id);

        if (! $family) {
            return response()->json([
                'message' => 'Measurement Family not found',
            ], 404);
        }

        $units = json_decode($family->units ?? '[]', true);

        $newUnit = [
            'code'   => request('code'),
            'labels' => [
                'en_US' => request('label'),
            ],
            'symbol' => request('symbol'),
        ];

        $units[] = $newUnit;

        $this->measurementFamilyRepository->update([
            'units' => json_encode($units),
        ], $id);

        return response()->json([
            'message' => 'Unit added successfully',
        ]);
    }

    public function editUnit($family_id, $code)
    {
        $family = $this->measurementFamilyRepository->find($family_id);

        $units = json_decode($family->units ?? '[]', true);

        // Find unit by code
        $unit = collect($units)->firstWhere('code', $code);

        if (! $unit) {
            abort(404, 'Unit not found');
        }

        return view('measurement::admin.units.edit', compact('family', 'unit'));
    }

    public function updateUnit($family_id, $code)
    {
        $family = $this->measurementFamilyRepository->find($family_id);
        $units = json_decode($family->units ?? '[]', true);

        // Get labels array from form
        $labels = request('labels', []);

        foreach ($units as &$item) {

            if ($item['code'] === $code) {

                // Update labels
                $item['labels']['en_US'] = $labels['en_US'] ?? null;
                $item['labels']['es_CA'] = $labels['es_CA'] ?? null;
                $item['labels']['de_DE'] = $labels['de_DE'] ?? null;
                $item['labels']['es_ES'] = $labels['es_ES'] ?? null;

                // Update symbol
                $item['symbol'] = request('symbol');
            }
        }

        // Save JSON back to DB
        $this->measurementFamilyRepository->update([
            'units' => json_encode($units),
        ], $family_id);

        return redirect()
            ->route('admin.measurement.families.edit', $family_id)
            ->with('success', 'Unit updated successfully');
    }

    public function deleteUnit($family_id, $code)
    {
        $family = $this->measurementFamilyRepository->findOrFail($family_id);

        $units = $family->units;

        if (is_string($units)) {
            $units = json_decode($units, true);
        }
        if (! is_array($units)) {
            $units = [];
        }

        $updatedUnits = array_filter($units, function ($unit) use ($code) {
            return isset($unit['code']) && $unit['code'] !== $code;
        });

        // Update DB
        $this->measurementFamilyRepository->update([
            'units' => array_values($updatedUnits),
        ], $family_id);

        return response()->json([
            'status'  => true,
            'message' => 'Unit deleted successfully.',
        ]);
    }

    public function unitmassDelete()
    {
        $ids = request()->input('indices');

        if (! $ids || count($ids) == 0) {
            session()->flash('error', 'No items selected.');

            return redirect()->back();
        }

        foreach ($ids as $id) {
            $this->measurementFamilyRepository->delete($id);
        }

        session()->flash('success', 'Selected measurement families deleted successfully.');

        return redirect()->back();
    }
}
