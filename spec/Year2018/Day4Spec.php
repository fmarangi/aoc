<?php

namespace spec\Mzentrale\AdventOfCode\Year2018;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day4Spec extends ObjectBehavior
{
    private $example = '[1518-11-01 00:00] Guard #10 begins shift
[1518-11-01 00:05] falls asleep
[1518-11-01 00:25] wakes up
[1518-11-01 00:30] falls asleep
[1518-11-01 00:55] wakes up
[1518-11-01 23:58] Guard #99 begins shift
[1518-11-02 00:40] falls asleep
[1518-11-02 00:50] wakes up
[1518-11-03 00:05] Guard #10 begins shift
[1518-11-03 00:24] falls asleep
[1518-11-03 00:29] wakes up
[1518-11-04 00:02] Guard #99 begins shift
[1518-11-04 00:36] falls asleep
[1518-11-04 00:46] wakes up
[1518-11-05 00:03] Guard #99 begins shift
[1518-11-05 00:45] falls asleep
[1518-11-05 00:55] wakes up';

    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_gets_the_target_guard()
    {
        $this->getTargetGuard($this->example)->shouldReturn(10);
    }

    function it_gets_the_target_minute()
    {
        $this->getTargetMinute($this->example)->shouldReturn(24);
    }

    function it_gets_the_most_slept_minutes()
    {
        $this->getMostSleptMinute($this->example)->shouldReturn(4455);
    }

    function it_solves_the_puzzle()
    {
        $this->part1($this->example)->shouldReturn(240);
        $this->part2($this->example)->shouldReturn(4455);

        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2018/day4.txt');
        $this->part1($input)->shouldReturn(151754);
        $this->part2($input)->shouldReturn(19896);
    }
}
