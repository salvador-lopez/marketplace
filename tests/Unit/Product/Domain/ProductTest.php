<?php

namespace Unit\Product\Domain;

use App\Product\Domain\Ean;
use App\Product\Domain\InvalidEanException;
use App\Product\Domain\Product;
use Faker\Factory;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

class ProductTest extends TestCase
{
    use ProphecyTrait;

    /**
     * @test
     *
     * @throws InvalidEanException
     */
    public function shouldCreateProductWithExpectedData(): void
    {
        $id = new Ean(Factory::create()->ean13());
        $product = new Product($id);

        $getEanPropertyClosure = function (): Ean {
            return $this->id;
        };

        $doGetEanPropertyClosure = $getEanPropertyClosure->bindTo($product, get_class($product));

        $this->assertEquals($id, $doGetEanPropertyClosure());
    }
}
