<?php

namespace Mzentrale\AdventOfCode\Year2018;

use Mzentrale\AdventOfCode\Puzzle;

class Day11 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->getLargestTotalPower((int) $input)[0];
    }

    public function part2(string $input)
    {
        return $this->getLargestTotalPowerWithSize((int) $input)[0];
    }

    public function getFuelLevel(int $x, int $y, int $gridSerial): int
    {
        $rackId     = $x + 10;
        $powerLevel = $rackId * $y + $gridSerial;
        $hundreds   = floor($powerLevel * $rackId / 100) % 10;
        return $hundreds - 5;
    }

    public function getTotalPower(int $x, int $y, int $gridSerial, int $size = 3): int
    {
        $power = 0;
        for ($j = 0; $j < $size; $j++) {
            for ($k = 0; $k < $size; $k++) {
                $power += $this->getFuelLevel($x + $j, $y + $k, $gridSerial);
            }
        }
        return $power;
    }

    public function getLargestTotalPower(int $gridSerial, int $size = 3, int $grid = 300): array
    {
        $power = [];
        for ($j = 1; $j <= $grid - $size + 1; $j++) {
            for ($k = 1; $k <= $grid - $size + 1; $k++) {
                $power["{$j},{$k}"] = $this->getTotalPower($j, $k, $gridSerial, $size);
            }
        }
        return [array_search(max($power), $power), max($power)];
    }

    public function getLargestTotalPowerWithSize(int $gridSerial, int $max = 16): array
    {
        $prev = 0;
        $best = '';
        for ($i = 1; $i <= $max; $i++) {
            list($cell, $power) = $this->getLargestTotalPower($gridSerial, $i);
            if ($power > $prev) {
                $prev = $power;
                $best = "{$cell},{$i}";
            }
        }
        return [$best, $prev];
    }
}
