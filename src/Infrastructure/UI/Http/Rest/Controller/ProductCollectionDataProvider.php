<?php

namespace App\Infrastructure\UI\Http\Rest\Controller;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Infrastructure\UI\Http\Rest\Resource\Product;

final class ProductCollectionDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): iterable
    {
        yield new Product('1234567898765');
        yield new Product('9876543212345');
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Product::class === $resourceClass;
    }
}