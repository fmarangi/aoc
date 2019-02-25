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
        $hundreds   = intdiv($powerLevel * $rackId, 100) % 10;
        return $hundreds - 5;
    }

    private function totalPower(array $table): callable
    {
        return function (int $x, int $y, int $size = 3) use ($table): int {
            [$a, $b, $c, $d] = [$x, $y, $x + $size, $y + $size];
            return $table[$b][$a] + $table[$d][$c] - $table[$b][$c] - $table[$d][$a];
        };
    }

    public function getLargestTotalPower(int $gridSerial, int $size = 3, int $gridSize = 300): array
    {
        $power = $this->totalPower($this->getSummedAreaTable($gridSerial, $gridSize));
        for ($x = 1, $result = []; $x <= $gridSize - $size; $x++) {
            for ($y = 1; $y <= $gridSize - $size; $y++) {
                $result["{$x},{$y}"] = $power($x - 1, $y - 1, $size);
            }
        }
        return [array_search(max($result), $result), max($result)];
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

    private function getSummedAreaTable(int $serial, int $size = 300): array
    {
        for ($y = 0, $grid = []; $y < $size; $y++) {
            for ($x = 0; $x < $size; $x++) {
                $grid[$y][$x] = $this->getFuelLevel($x, $y, $serial);
            }
        }

        $t = [];
        foreach ($grid as $y => $row) {
            foreach ($row as $x => $cell) {
                $t[$y][$x] = $cell - ($t[$y - 1][$x - 1] ?? 0) + ($t[$y][$x - 1] ?? 0) + ($t[$y - 1][$x] ?? 0);
            }
        }
        return $t;
    }
}
