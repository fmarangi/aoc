<?php

namespace Mzentrale\AdventOfCode\Year2018;

use Mzentrale\AdventOfCode\Puzzle;
use Mzentrale\AdventOfCode\Year2018\Day8\Node;

class Day8 implements Puzzle
{
    public function part1(string $input)
    {
        $tree = new Node(trim($input));
        return $tree->getMetadataSum();
    }

    public function part2(string $input)
    {
        $tree = new Node(trim($input));
        return $tree->getValue();
    }
}
