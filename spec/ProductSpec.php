<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ProductSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedThrough(
            'withSkuAndCost',
            [
                new \Sku('CIAS'),
                New \Cost(10.50)
            ]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Product');
    }

    function it_should_get_cost_of_product()
    {
        $this->getCost()->shouldBeLike(new \Cost(10.50));
    }
}
