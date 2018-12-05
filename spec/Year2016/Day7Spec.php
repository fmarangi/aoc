<?php

namespace spec\Mzentrale\AdventOfCode\Year2016;

use Mzentrale\AdventOfCode\Puzzle;
use PhpSpec\ObjectBehavior;

class Day7Spec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Puzzle::class);
    }

    function it_checks_abba()
    {
        $this->isAbba('ioxxoj')->shouldReturn(true);
        $this->isAbba('abba')->shouldReturn(true);
        $this->isAbba('aaaa')->shouldReturn(false);
        $this->isAbba('bddb')->shouldReturn(true);
    }

    function it_checks_tls_support()
    {
        $this->supportsTls('abba[mnop]qrst')->shouldReturn(true);
        $this->supportsTls('abcd[bddb]xyyx')->shouldReturn(false);
        $this->supportsTls('aaaa[qwer]tyui')->shouldReturn(false);
        $this->supportsTls('ioxxoj[asdfgh]zxcvbn')->shouldReturn(true);
    }

    function it_checks_the_aba()
    {
        $this->isAba('xyx')->shouldReturn(true);
        $this->isAba('xxx')->shouldReturn(false);
        $this->isAba('abc')->shouldReturn(false);
    }

    function it_calculates_the_bab()
    {
        $this->getBab('xyx')->shouldReturn('yxy');
    }

    function it_checks_ssl_support()
    {
        $this->supportsSsl('aba[bab]xyz')->shouldReturn(true);
        $this->supportsSsl('xyx[xyx]xyx')->shouldReturn(false);
        $this->supportsSsl('aaa[kek]eke')->shouldReturn(true);
        $this->supportsSsl('zazbz[bzb]cdb')->shouldReturn(true);
    }

    function it_solves_the_puzzle()
    {
        $input = file_get_contents(dirname(dirname(__DIR__)) . '/input/year2016/day7.txt');
        $this->part1($input)->shouldReturn(105);
        $this->part2($input)->shouldReturn(258);
    }
}
