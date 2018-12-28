<?php

namespace Mzentrale\AdventOfCode\Year2018;

use Mzentrale\AdventOfCode\Puzzle;

class Day18 implements Puzzle
{
    const OPEN       = '.';
    const TREE       = '|';
    const LUMBERYARD = '#';

    public function part1(string $input)
    {
        return $this->getTotalResourceValue($input, 10);
    }

    public function part2(string $input)
    {
        return $this->getTotalResourceValue($input, 610 + (1000000000 - 610) % 28);
    }

    public function getTotalResourceValue(string $input, int $minutes): int
    {
        $landscape = $this->parseInput($input);
        for ($i = 0; $i < $minutes; $i++) {
            $landscape = $this->next($landscape);
        }
        return $this->getValue($landscape);
    }

    private function getValue(array $landscape): int
    {
        $result = implode('', $landscape);
        return $this->count($result, self::TREE) * $this->count($result, self::LUMBERYARD);
    }

    private function next(array $landscape): array
    {
        $next = array_fill(0, count($landscape), '');
        for ($y = 0, $maxY = count($landscape); $y < $maxY; $y++) {
            for ($x = 0, $maxX = strlen($landscape[$y]); $x < $maxX; $x++) {
                switch ($landscape[$y]{$x}) {
                    case self::OPEN:
                        $next[$y] .= $this->count($this->getAdjacent($landscape, $x, $y), self::TREE) >= 3 ? self::TREE : self::OPEN;
                        break;
                    case self::TREE:
                        $next[$y] .= $this->count($this->getAdjacent($landscape, $x, $y), self::LUMBERYARD) >= 3 ? self::LUMBERYARD : self::TREE;
                        break;
                    case self::LUMBERYARD:
                        $adjacent = $this->getAdjacent($landscape, $x, $y);
                        $next[$y] .= $this->count($adjacent, self::LUMBERYARD) >= 1 && $this->count($adjacent, self::TREE) >= 1 ? self::LUMBERYARD : self::OPEN;
                        break;
                }
            }
        }
        return $next;
    }

    private function parseInput(string $input): array
    {
        return explode(PHP_EOL, trim($input));
    }

    private function getAdjacent(array $landscape, int $x, int $y): string
    {
        $adjacent = '';
        if ($y - 1 >= 0) $adjacent .= substr($landscape[$y - 1], $x - 1 >= 0 ? $x - 1 : 0, $x - 1 >= 0 ? 3 : 2);
        if ($y + 1 < count($landscape)) $adjacent .= substr($landscape[$y + 1], $x - 1 >= 0 ? $x - 1 : 0, $x - 1 >= 0 ? 3 : 2);
        if ($x - 1 >= 0) $adjacent .= $landscape[$y]{$x - 1};
        if ($x + 1 < strlen($landscape[$y])) $adjacent .= $landscape[$y]{$x + 1};
        return $adjacent;
    }

    private function count(string $adjacent, string $acre): string
    {
        return substr_count($adjacent, $acre);
    }
}
