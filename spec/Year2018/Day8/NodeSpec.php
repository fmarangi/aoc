<?php

namespace spec\Mzentrale\AdventOfCode\Year2018\Day8;

use Mzentrale\AdventOfCode\Year2018\Day8\Node;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class NodeSpec extends ObjectBehavior
{
    function it_calculates_the_metadata_sum()
    {
        $license = '2 3 0 3 10 11 12 1 1 0 1 99 2 1 1 2';
        $this->beConstructedWith(explode(' ', $license));
        $this->getMetadataSum()->shouldReturn(138);
    }

    function it_calculates_the_node_value()
    {
        $license = '2 3 0 3 10 11 12 1 1 0 1 99 2 1 1 2';
        $this->beConstructedWith(explode(' ', $license));
        $this->getValue()->shouldReturn(66);
    }
}
