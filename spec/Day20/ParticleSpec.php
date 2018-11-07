<?php

namespace spec\Mzentrale\AdventOfCode\Day20;

use Mzentrale\AdventOfCode\Day20\Particle;
use PhpSpec\ObjectBehavior;

class ParticleSpec extends ObjectBehavior
{
    function let()
    {
        $id           = 1;
        $position     = [3, 0, 0];
        $velocity     = [2, 0, 0];
        $acceleration = [-1, 0, 0];
        $this->beConstructedWith($id, $position, $velocity, $acceleration);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Particle::class);
    }

    function it_should_calculate_the_distance()
    {
        $this->getDistance()->shouldReturn(3);
    }

    function it_should_get_the_id()
    {
        $this->getId()->shouldReturn(1);
    }

    function it_should_get_the_position()
    {
        $this->getPosition()->shouldReturn([3, 0, 0]);
    }

    function it_should_update_the_position()
    {
        $this->update();
        $this->getDistance()->shouldReturn(4);

        $this->update();
        $this->getDistance()->shouldReturn(4);

        $this->update();
        $this->getDistance()->shouldReturn(3);
    }
}
