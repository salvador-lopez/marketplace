<?php

namespace App\Infrastructure\UI\Http\Rest\Controller;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Product\Application\Command\CreateProductCommand;
use App\Product\Application\Command\CreateProductCommandHandler;
use App\Product\Application\DTO\Product;
use App\Product\Domain\InvalidEanException;
use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

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
    public function persist(
        $data,
        #[ArrayShape([
            'resource_class' => 'string',
            'has_composite_identifier' => 'bool',
            'identifiers' => 'array',
            'collection_operation_name' => 'string',
            'receive' => 'boolean',
            'respond' => 'boolean',
            'persists' => 'boolean',
        ])]
        array $context = []
    ): void {
        if ($context['collection_operation_name'] === 'post') {
            $this->createProductCommandHandler->handle(new CreateProductCommand($data));
        }
    }

    public function remove($data, array $context = [])
    {
        throw new MethodNotAllowedHttpException(['get', 'post']);
    }
}