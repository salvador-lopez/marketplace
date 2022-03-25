<?php

namespace App\Product\Application\Command;

use App\Product\Domain\Ean;
use App\Product\Domain\InvalidEanException;
use App\Product\Domain\Product;
use App\Product\Domain\ProductRepository;

final class CreateProductCommandHandler
{
    private ProductRepository $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @throws InvalidEanException
     */
    public function handle(CreateProductCommand $command): void
    {
        $this->repository->save(new Product(new Ean($command->getProduct()->id)));
    }
}