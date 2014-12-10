<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CostSpec extends ObjectBehavior
{
    function it_could_be_converted_to_float()
    {
        $this->beConstructedWith(12.3);

        $this->toFloat()->shouldReturn(12.3);
    }
}
