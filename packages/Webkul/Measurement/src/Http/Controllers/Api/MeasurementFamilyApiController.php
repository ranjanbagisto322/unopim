<?php

namespace Webkul\Measurement\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Webkul\Measurement\Repository\MeasurementFamilyRepository;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class MeasurementFamilyApiController extends Controller
{
    public function __construct(
        protected MeasurementFamilyRepository $repository
    ) {}


    public function index()
    {
        
        $data = $this->repository->all();

        return response()->json([
            'success' => true,
            'count'   => $data->count(),
            'data'    => $data,
        ]);
    }


    public function store(Request $request)
    {
        $family = $this->repository->create($request->all());

        return response()->json([
            'success' => true,
            'data'    => $family,
        ]);
    }

    public function update(Request $request, $id)
    {
        $family = $this->repository->find($id);

        if (! $family) {
            return response()->json([
                'success' => false,
                'message' => 'Measurement family not found',
            ], 404);
        }

        $this->repository->update($request->all(), $id);

        return response()->json([
            'success' => true,
            'message' => 'Measurement family updated successfully',
        ]);
    }


    public function destroy($id)
    {
        $this->repository->delete($id);

        return response()->json([
            'success' => true,
            'message' => 'Measurement family deleted successfully',
        ]);
    }

}
