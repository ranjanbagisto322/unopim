<?php

namespace Webkul\Measurement\Http\Controllers;

use Webkul\Admin\Http\Controllers\VueJsSelect\AbstractOptionsController;
use Webkul\Measurement\Repository\MeasurementFamilyRepository;
use Webkul\Attribute\Repositories\AttributeRepository;
use Webkul\Core\Repositories\LocaleRepository;
use Webkul\Core\Repositories\CurrencyRepository;
use Webkul\Core\Repositories\ChannelRepository;
use Webkul\Category\Repositories\CategoryFieldRepository;
use Webkul\Measurement\Repository\AttributeMeasurementRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class MeasurementOptionsController extends AbstractOptionsController
{
    protected MeasurementFamilyRepository $measurementFamilyRepository;
    protected AttributeMeasurementRepository $attributeMeasurementRepository;

    public function __construct(
        MeasurementFamilyRepository $measurementFamilyRepository,
        AttributeRepository $attributeRepository,
        LocaleRepository $localeRepository,
        CurrencyRepository $currencyRepository,
        ChannelRepository $channelRepository,
        CategoryFieldRepository $categoryFieldRepository,
        AttributeMeasurementRepository $attributeMeasurementRepository
    ) {
        parent::__construct(
            $attributeRepository,
            $localeRepository,
            $currencyRepository,
            $channelRepository,
            $categoryFieldRepository
        );

        $this->measurementFamilyRepository     = $measurementFamilyRepository;
        $this->attributeMeasurementRepository = $attributeMeasurementRepository;
    }

    public function getOptions(): JsonResponse
    {
        $attributeId = request('attribute_id');
        $page        = request('page', 1);
        $query       = request('query', '');
        $queryParams = request('queryParams', []);

        // Get measurement info based on attribute id
        $attributeMeasurement = $this->attributeMeasurementRepository->getByAttributeId($attributeId);
            
        $familyCode = $attributeMeasurement?->family_code;


        // If no family selected yet, return empty list
        if (!$familyCode) {
            return response()->json([
                'options'  => [],
                'page'     => 1,
                'lastPage' => 1,
            ]);
        }

        // Get all units for the family
        $units = collect(
            $this->measurementFamilyRepository->getUnitsByFamilyCode($familyCode)
        )->map(function ($unit) {
            return (object) [
                'id'    => $unit['code'],
                'label' => $unit['label'] ?? $unit['code'],
                'code'  => $unit['code'],
            ];
        });

        $options = $this->formatCollection(
            $units,
            $page,
            50,
            $query,
            $queryParams
        );

        return response()->json($options);
    }

    protected function formatCollection(
        Collection $collection,
        int $page,
        int $limit,
        string $query,
        array $queryParams
    ): array {
        // Put the old selected value on top
        if (isset($queryParams['identifiers']['value'])) {
            $identifier = $queryParams['identifiers']['value'];

            $collection = $collection->sortByDesc(fn($item) => $item->id === $identifier);
        }

        // Paginate
        $paginated = $collection->forPage($page, $limit)->values();

        return [
            'options'  => $paginated,
            'page'     => $page,
            'lastPage' => ceil($collection->count() / $limit),
        ];
    }
}
