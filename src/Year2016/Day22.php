<?php

namespace Mzentrale\AdventOfCode\Year2016;

use Mzentrale\AdventOfCode\Puzzle;

class Day22 implements Puzzle
{
    const USED  = 3;
    const AVAIL = 4;

    public function part1(string $input)
    {
        $grid = $this->parseInput($input);
        return array_sum(array_map(function (array $node) use ($grid): int {
            return $node[self::USED] ? array_sum(array_map($this->viable($node), $grid)) : 0;
        }, $grid));
    }

    public function part2(string $input)
    {
        // TODO: Implement part2() method.
    }

    private function viable(array $node): callable
    {
        return function (array $other) use ($node): bool {
            return $node !== $other && $node[self::USED] <= $other[self::AVAIL];
        };
    }

    private function parseInput(string $input): array
    {
        return array_values(array_filter(array_map(function (string $line): array {
            preg_match('#/dev/grid/node-x(\d+)-y(\d+)\s+(\d+)T\s+(\d+)T\s+(\d+)T#', $line, $match);
            return array_map('intval', array_slice($match, 1));
        }, explode(PHP_EOL, trim($input)))));
    }
}
