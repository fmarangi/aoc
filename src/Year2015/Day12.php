<?php

namespace Mzentrale\AdventOfCode\Year2015;

use Mzentrale\AdventOfCode\Puzzle;

class Day12 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->getSum($input);
    }

    public function part2(string $input)
    {
        return $this->getSumWithoutRed($input);
    }

    public function getSum(string $json): int
    {
        return $this->sum($this->parseInput($json));
    }

    public function getSumWithoutRed(string $json): int
    {
        return $this->sum($this->parseInput($json), function ($data) {
            return is_string(array_search('red', $data, true));
        });
    }

    private function sum(array $data, ?callable $hasRed = null): int
    {
        return array_sum(array_map(function ($el) use ($hasRed) {
            switch (true) {
                case is_int($el):
                    return $el;
                case is_array($el):
                    return $this->sum($el, $hasRed);
            }
            return 0;
        }, $hasRed && $hasRed($data) ? [] : $data));
    }

    private function parseInput(string $json): array
    {
        return json_decode(trim($json), JSON_OBJECT_AS_ARRAY);
    }
}
