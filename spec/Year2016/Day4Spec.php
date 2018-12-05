<?php

namespace spec\Mzentrale\AdventOfCode\Year2016;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day4Spec extends ObjectBehavior
{
    private $rooms = [
        'aaaaa-bbb-z-y-x-123[abxyz]'   => true,
        'a-b-c-d-e-f-g-h-987[abcde]'   => true,
        'not-a-real-room-404[oarel]'   => true,
        'totally-real-room-200[decoy]' => false,
    ];

    function it_is_a_puzzle()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_validates_room_name()
    {
        foreach ($this->rooms as $name => $result) {
            $this->isValid($name)->shouldReturn($result);
        }
        $this->isValid('raphhxuxts-hrpktcvtg-wjci-sthxvc-765[htcxp]')->shouldReturn(true);
    }

    function it_calculates_the_sum_of_sectors()
    {
        $this->getSectors(implode(PHP_EOL, array_keys($this->rooms)))->shouldReturn(1514);
    }

    function it_decrypts_the_room_name()
    {
        $this->decrypt('qzmt-zixmtkozy-ivhz', 343)->shouldReturn('very encrypted name');
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2016/day4.txt');
        $this->part1($input)->shouldReturn(173787);
        $this->part2($input)->shouldReturn(548);
    }
}
