<?php

namespace App\Infrastructure\UI\Http\Rest\Controller;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Infrastructure\UI\Http\Rest\Resource\Product;
use JetBrains\PhpStorm\Pure;

class ProductItemDataProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
{
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return $resourceClass === Product::class;
    }


    #[Pure] public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): Product
    {
        return new Product('1234567898765');
    }
}