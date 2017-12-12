<?php

namespace spec\Mzentrale\AdventOfCode;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day4Spec extends ObjectBehavior
{
    public function it_should_be_a_puzzle()
    {
        $this->shouldImplement(Puzzle::class);
    }

    public function it_should_check_passphrase_uniqueness()
    {
        $this->checkPassphrase('aa bb cc dd ee')->shouldReturn(true);
        $this->checkPassphrase('aa bb cc dd aa')->shouldReturn(false);
        $this->checkPassphrase('aa bb cc dd aaa')->shouldReturn(true);
    }

    public function it_should_count_unique()
    {
        $this->countUnique("aa bb cc dd ee
aa bb cc dd aa
aa bb cc dd aaa")->shouldReturn(2);
    }
}
