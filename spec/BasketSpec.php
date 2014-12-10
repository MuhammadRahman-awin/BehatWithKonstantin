<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BasketSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Basket');
    }

    function it_should_cost_0_by_default()
    {
        $this->getTotalPrice()->shouldBeLike(new \Cost(0.0));
    }

    function it_calculates_product_priced_less_than_10_pounds(\Catalogue $catalogue)
    {
        $aSku = new \Sku('Rs1');
        $aProduct = \Product::withSkuAndCost($aSku, new \Cost(5.0));

        $catalogue->getProduct($aSku)->willReturn($aProduct);

        $this->addProductFromCatalogue($aSku, $catalogue);

        $this->getTotalPrice()->shouldBeLike(new \Cost(9.0));
    }

    function it_calculates_product_priced_more_than_10_pounds(\Catalogue $catalogue)
    {
        $aSku = new \Sku('Rs1');
        $aProduct = \Product::withSkuAndCost($aSku, new \Cost(15.0));

        $catalogue->getProduct($aSku)->willReturn($aProduct);

        $this->addProductFromCatalogue($aSku, $catalogue);

        $this->getTotalPrice()->shouldBeLike(new \Cost(20.0));
    }

    function it_calculates_product_priced_exactly_10_pounds(\Catalogue $catalogue)
    {
        $aSku = new \Sku('Rs1');
        $aProduct = \Product::withSkuAndCost($aSku, new \Cost(10.0));

        $catalogue->getProduct($aSku)->willReturn($aProduct);

        $this->addProductFromCatalogue($aSku, $catalogue);

        $this->getTotalPrice()->shouldBeLike(new \Cost(15.0));
    }
}
