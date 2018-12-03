<?php

namespace Mzentrale\AdventOfCode\Year2018;

use Mzentrale\AdventOfCode\Puzzle;

class Day3 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->getOverlapping($input);
    }

    public function part2(string $input)
    {
        return $this->getIntact($input);
    }

    public function getOverlapping(string $input): int
    {
        $fabric = $this->getFabric($this->parseInput($input));
        return count(array_filter($fabric, function (array $inch) {
            return count($inch) > 1;
        }));
    }

    private function parseInput(string $input): array
    {
        return array_reduce(explode(PHP_EOL, trim($input)), function (array $result, string $row) {
            list($claim, $coordinates) = explode(' @ ', trim($row, '#'));
            $result[$claim] = sscanf($coordinates, '%d,%d: %dx%d');
            return $result;
        }, []);
    }

    public function getIntact(string $input)
    {
        $claims = $this->parseInput($input);
        $valid  = array_flip(array_keys($claims));
        foreach ($this->getFabric($claims) as $cell) {
            if (count($cell) > 1) {
                foreach ($cell as $claim) {
                    unset($valid[$claim]);
                }
            }
        }
        return count($valid) === 1 ? array_keys($valid)[0] : 0;
    }

    private function getFabric(array $claims): array
    {
        $fabric = [];
        foreach ($claims as $claim => list($x, $y, $width, $height)) {
            for ($j = 0; $j < $width; $j++) {
                for ($k = 0; $k < $height; $k++) {
                    $fabric[sprintf('%d:%d', $x + $j, $y + $k)][] = $claim;
                }
            }
        }
        return $fabric;
    }
}
