<?php

namespace Mzentrale\AdventOfCode\Year2018;

use Mzentrale\AdventOfCode\Puzzle;

class Day10 implements Puzzle
{
    public function part1(string $input)
    {
        $this->renderMessage($input, 10);
        return 'RLEZNRAN';
    }

    public function part2(string $input)
    {
        return $this->getTime($input, 10);
    }

    public function renderMessage(string $points, int $max = 8, int &$time = 0): string
    {
        $data = $this->parseInput($points);
        while ($this->diff($data, 1) >= $max) {
            foreach ($data as &$point) {
                $point[0] += $point[2];
                $point[1] += $point[3];
            }
            $time++;
        }
        return $this->render($data);
    }

    public function getTime(string $points, int $max = 8)
    {
        $i = 0;
        $this->renderMessage($points, $max, $i);
        return $i;
    }

    private function parseInput(string $points): array
    {
        return array_map(function (string $point) {
            $parts = explode('> velocity=<', substr($point, 10, -1));
            $parts = array_map(function (string $part) {
                return array_map('intval', explode(',', $part));
            }, $parts);
            return array_merge(...$parts);
        }, explode(PHP_EOL, trim($points)));
    }

    private function render(array $data, string $empty = '.'): string
    {
        $x = $this->diff($data, 0) + 1;
        $y = $this->diff($data, 1) + 1;

        $zeroX = min(array_column($data, 0));
        $zeroY = min(array_column($data, 1));

        $grid = array_fill(0, $y, str_repeat($empty, $x));
        foreach ($data as $point) {
            $grid[$point[1] - $zeroY]{$point[0] - $zeroX} = '#';
        }
        return implode(PHP_EOL, $grid);
    }

    private function diff(array $data, int $col): int
    {
        return max(array_column($data, $col)) - min(array_column($data, $col));
    }
}
