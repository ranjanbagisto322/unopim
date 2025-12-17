<?php

namespace Webkul\Measurement\Http\Controllers\Vuejs;

use Webkul\Admin\Http\Controllers\VueJsSelect\AbstractOptionsController;
use Webkul\Measurement\Repository\MeasurementFamilyRepository;
use Webkul\Attribute\Repositories\AttributeRepository;
use Webkul\Core\Repositories\LocaleRepository;
use Webkul\Core\Repositories\CurrencyRepository;
use Webkul\Core\Repositories\ChannelRepository;
use Webkul\Category\Repositories\CategoryFieldRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class MeasurementOptionsController extends AbstractOptionsController
{
    protected MeasurementFamilyRepository $measurementFamilyRepository;

    public function __construct(
        MeasurementFamilyRepository $measurementFamilyRepository,
        AttributeRepository $attributeRepository,
        LocaleRepository $localeRepository,
        CurrencyRepository $currencyRepository,
        ChannelRepository $channelRepository,
        CategoryFieldRepository $categoryFieldRepository
    ) {
        parent::__construct(
            $attributeRepository,
            $localeRepository,
            $currencyRepository,
            $channelRepository,
            $categoryFieldRepository
        );

        $this->measurementFamilyRepository = $measurementFamilyRepository;
    }

    public function getOptions(): JsonResponse
    {
        $familyCode = request('family');
        $page       = request('page', 1);
        $query      = request('query', '');

        
        $queryParams = request('queryParams', []);

       
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
      
        if (isset($queryParams['identifiers']['value'])) {
            $identifier = $queryParams['identifiers']['value'];

            $collection = $collection->sortByDesc(
                fn ($item) => $item->id === $identifier
            );
        }

        $paginated = $collection->forPage($page, $limit)->values();

        return [
            'options'  => $paginated,
            'page'     => $page,
            'lastPage' => ceil($collection->count() / $limit),
        ];
    }
}
