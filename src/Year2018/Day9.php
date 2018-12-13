<?php

namespace Mzentrale\AdventOfCode\Year2018;

use Mzentrale\AdventOfCode\Puzzle;
use Mzentrale\AdventOfCode\Year2018\Day9\Marble;

class Day9 implements Puzzle
{
    public function part1(string $input)
    {
        list($players, $lastMarble) = $this->parseInput($input);
        return $this->getWinningScoreOptimized($players, $lastMarble);
    }

    public function part2(string $input)
    {
        list($players, $lastMarble) = $this->parseInput($input);
        return $this->getWinningScoreOptimized($players, $lastMarble * 2);
    }

    public function getWinningScore(int $players, int $lastMarble): int
    {
        $scores  = array_fill(0, $players, 0);
        $circle  = [0];
        $current = 0;
        for ($i = 1; $i <= $lastMarble; $i++) {
            $qty = count($circle);
            if ($i % 23 === 0) {
                $p          = ($i - 1) % $players;
                $bonus      = ($current + $qty - 7) % $qty;
                $scores[$p] += $i + $circle[$bonus];
                array_splice($circle, $bonus, 1);
                $current = $bonus;
                continue;
            }

            $current = ($current + 2) % $qty;
            array_splice($circle, $current, 0, $i);
        }
        return max($scores);
    }

    public function getWinningScoreOptimized(int $players, int $lastMarble): int
    {
        $scores  = array_fill(0, $players, 0);
        $current = new Marble(0);
        for ($i = 1; $i <= $lastMarble; $i++) {
            if ($i % 23 === 0) {
                $p          = ($i - 1) % $players;
                $bonus      = $current->prev(7);
                $scores[$p] += $i + $bonus->getValue();
                $current    = $bonus->delete();
                continue;
            }

            $current = $current->next()->insertAfter($i);
        }
        return max($scores);
    }

    private function parseInput(string $input): array
    {
        return (array) sscanf(trim($input), '%d players; last marble is worth %d points');
    }
}
