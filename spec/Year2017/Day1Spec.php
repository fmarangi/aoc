<?php

namespace spec\Mzentrale\AdventOfCode\Year2017;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day1Spec extends ObjectBehavior
{
    public function it_should_be_a_puzzle()
    {
        $this->shouldImplement(Puzzle::class);
    }

    public function it_should_calculate_simple_cases()
    {
        $this->captcha('1234')->shouldReturn(0);
        $this->captcha('1122')->shouldReturn(3);
        $this->captcha('1111')->shouldReturn(4);
        $this->captcha('91212129')->shouldReturn(9);
    }

    public function it_should_calculate_with_dynamic_steps()
    {
        $this->captchaHalf('1212')->shouldReturn(6);
        $this->captchaHalf('1221')->shouldReturn(0);
        $this->captchaHalf('123425')->shouldReturn(4);
        $this->captchaHalf('123123')->shouldReturn(12);
        $this->captchaHalf('12131415')->shouldReturn(4);
    }

    public function it_should_solve_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2017/day1.txt');
        $this->part1($input)->shouldReturn(1341);
        $this->part2($input)->shouldReturn(1348);
    }
}
