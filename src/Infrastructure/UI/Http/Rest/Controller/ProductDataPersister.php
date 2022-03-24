<?php

namespace App\Infrastructure\UI\Http\Rest\Controller;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Infrastructure\UI\Http\Rest\Resource\Product;
use App\Product\Application\Command\CreateProductCommand;
use App\Product\Application\Command\CreateProductCommandHandler;
use App\Product\Domain\InvalidEanException;

final class ProductDataPersister implements ContextAwareDataPersisterInterface
{
    private CreateProductCommandHandler $createProductCommandHandler;

    public function __construct(CreateProductCommandHandler $createProductCommandHandler)
    {
        $this->createProductCommandHandler = $createProductCommandHandler;
    }

    public function supports($data, array $context = []): bool
    {
        return $data instanceof Product;
    }

    /**
     * @param Product $data
     * @throws InvalidEanException
     */
    public function persist($data, array $context = []): void
    {
        $this->createProductCommandHandler->handle(new CreateProductCommand($data->getId()));
    }

    public function remove($data, array $context = [])
    {
        // TODO: Implement remove() method.
    }
}