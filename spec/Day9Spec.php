<?php

namespace spec\Mzentrale\AdventOfCode;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day9Spec extends ObjectBehavior
{
    function it_is_a_puzzle()
    {
        $this->shouldImplement(Puzzle::class);
    }

    function it_should_remove_garbage()
    {
        $this->removeGarbage('{{<>}}')->shouldReturn('{{}}');
        $this->removeGarbage('{{<random characters>}}')->shouldReturn('{{}}');
        $this->removeGarbage('{{<<<<>}}')->shouldReturn('{{}}');
        $this->removeGarbage('{{<{!>}>}}')->shouldReturn('{{}}');
        $this->removeGarbage('{{<!!>}}')->shouldReturn('{{}}');
        $this->removeGarbage('{{<!!!>>}}')->shouldReturn('{{}}');
        $this->removeGarbage('{{<{o"i!a,<{i<a>}}')->shouldReturn('{{}}');
        $this->removeGarbage('{{<!!>},{<!!>},{<!!>},{<!!>}}')->shouldReturn('{{},{},{},{}}');
        $this->removeGarbage('{{<a!>},{<a!>},{<a!>},{<ab>}}')->shouldReturn('{{}}');
    }

    function it_should_count_the_groups()
    {
        $this->countGroups('{}')->shouldReturn(1);
        $this->countGroups('{{{}}}')->shouldReturn(3);
        $this->countGroups('{{},{}}')->shouldReturn(3);
        $this->countGroups('{{{},{},{{}}}}')->shouldReturn(6);
        $this->countGroups('{<{},{},{{}}>}')->shouldReturn(1);
        $this->countGroups('{<a>,<a>,<a>,<a>}')->shouldReturn(1);
        $this->countGroups('{{<a>},{<a>},{<a>},{<a>}}')->shouldReturn(5);
        $this->countGroups('{{<!>},{<!>},{<!>},{<a>}}')->shouldReturn(2);
    }

    function it_should_calculate_the_score()
    {
        $this->calculateScore('{}')->shouldReturn(1);
        $this->calculateScore('{{{}}}')->shouldReturn(6);
        $this->calculateScore('{{},{}}')->shouldReturn(5);
        $this->calculateScore('{{{},{},{{}}}}')->shouldReturn(16);
        $this->calculateScore('{<a>,<a>,<a>,<a>}')->shouldReturn(1);
        $this->calculateScore('{{<ab>},{<ab>},{<ab>},{<ab>}}')->shouldReturn(9);
        $this->calculateScore('{{<!!>},{<!!>},{<!!>},{<!!>}}')->shouldReturn(9);
        $this->calculateScore('{{<a!>},{<a!>},{<a!>},{<ab>}}')->shouldReturn(3);
    }
}
