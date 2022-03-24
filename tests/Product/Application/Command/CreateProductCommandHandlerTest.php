<?php

namespace Product\Application\Command;

use App\Product\Application\Command\CreateProductCommand;
use App\Product\Application\Command\CreateProductCommandHandler;
use App\Product\Domain\Ean;
use App\Product\Domain\InvalidEanException;
use App\Product\Domain\Product;
use App\Product\Domain\ProductRepository;
use JetBrains\PhpStorm\ArrayShape;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;

class CreateProductCommandHandlerTest extends TestCase
{
    use ProphecyTrait;

    /**
     * @test
     *
     * @dataProvider getEanValueDataProvider
     * @throws InvalidEanException
     */
    public function shouldCallToRepositorySaveWithTheProductAsExpected(string $eanValue): void
    {
        /** @var ObjectProphecy|ProductRepository $repositoryProphecy */
        $repositoryProphecy = $this->prophesize(ProductRepository::class);

        $repositoryProphecy->save(new Product(new Ean($eanValue)))->shouldBeCalledOnce();

        $commandHandler = new CreateProductCommandHandler($repositoryProphecy->reveal());
        $commandHandler->handle(new CreateProductCommand($eanValue));
    }

    #[ArrayShape(['An ean' => "string[]", 'Another ean' => "string[]"])]
    public function getEanValueDataProvider(): array
    {
        return [
            'An ean' => ['1234567898765'],
            'Another ean' => ['9876543212345'],
        ];
    }

    /**
     * @test
     */
    public function shouldThrowInvalidEanExceptionAndNotCreateTheProductWhenEanIsInvalid(): void
    {
        $invalidEanValue = 'invalid-ean-value';
        /** @var ObjectProphecy|ProductRepository $repositoryProphecy */
        $repositoryProphecy = $this->prophesize(ProductRepository::class);

        $repositoryProphecy->save(Argument::type(Product::class))->shouldNotBeCalled();

        $commandHandler = new CreateProductCommandHandler($repositoryProphecy->reveal());

        $this->expectException(InvalidEanException::class);
        $commandHandler->handle(new CreateProductCommand($invalidEanValue));
    }
}
