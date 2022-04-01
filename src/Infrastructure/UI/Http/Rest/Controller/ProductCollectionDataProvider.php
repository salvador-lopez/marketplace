<?php

namespace App\Infrastructure\UI\Http\Rest\Controller;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Product\Application\DTO\Product;
use App\Product\Application\Query\QueryService;

final class ProductCollectionDataProvider implements CollectionDataProviderInterface, RestrictedDataProviderInterface
{
    private QueryService $queryService;

    public function __construct(QueryService $queryService)
    {
        $this->queryService = $queryService;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Product::class === $resourceClass;
    }

    /**
     * @param string $resourceClass
     * @param string|null $operationName
     * @return Product[]
     */
    public function getCollection(string $resourceClass, string $operationName = null): array
    {
        return $this->queryService->getAll();
    }
}