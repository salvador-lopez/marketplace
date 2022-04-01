<?php

namespace Unit\Infrastructure\UI\Http\Rest\Controller;

use App\Infrastructure\UI\Http\Rest\Controller\ProductCollectionDataProvider;
use App\Product\Application\DTO\Product;
use App\Product\Application\Query\QueryService;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;
use stdClass;

class ProductCollectionDataProviderTest extends TestCase
{
    use ProphecyTrait;

    private ProductCollectionDataProvider $dataProvider;

    private ObjectProphecy|QueryService $queryServiceProphecy;

    protected function setUp(): void
    {
        parent::setUp();

        $this->queryServiceProphecy = $this->prophesize(QueryService::class);
        $this->dataProvider = new ProductCollectionDataProvider($this->queryServiceProphecy->reveal());
    }

    /**
     * @test
     */
    public function shouldNotSupportClassDifferentThanProductDTO(): void
    {
        $this->assertFalse($this->dataProvider->supports(stdClass::class));
    }

    /**
     * @test
     */
    public function shouldSupportProductDTOClass(): void
    {
        $this->assertTrue($this->dataProvider->supports(Product::class));
    }

    /**
     * @test
     *
     * @dataProvider getProductDTOCollectionDataProvider
     */
    public function shouldGetProductDTOCollectionAsExpected(array $productDTOs): void
    {
        $this->queryServiceProphecy->getAll()->willReturn($productDTOs)->shouldBeCalledOnce();
        $this->assertEquals($productDTOs, $this->dataProvider->getCollection(Product::class));
    }

    #[Pure] #[ArrayShape(['no data' => "array", 'two Products' => "\App\Product\Application\DTO\Product[][]"])]
    public function getProductDTOCollectionDataProvider(): array
    {
        return [
            'no data' => [[]],
            'two Products' => [[new Product('1234567898765'), new Product('9876543212345')]]
        ];
    }
}
