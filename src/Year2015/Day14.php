<?php

namespace Mzentrale\AdventOfCode\Year2015;

use Mzentrale\AdventOfCode\Puzzle;

class Day14 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->getWinningDistance($input, 2503);
    }

    public function part2(string $input)
    {
        return $this->getWinningScore($input, 2503);
    }

    public function getWinningDistance(string $input, int $duration): int
    {
        $data      = $this->parseInput($input);
        $distances = array_combine(array_column($data, 0), array_fill(0, count($data), 0));
        for ($i = 0; $i < $duration; $i++) {
            foreach ($data as $reindeer) {
                if ($i % ($reindeer[2] + $reindeer[3]) < $reindeer[2]) {
                    $distances[$reindeer[0]] += $reindeer[1];
                }
            }
        }
        return max($distances);
    }

    public function getWinningScore(string $input, int $duration): int
    {
        $data      = $this->parseInput($input);
        $distances = $score = array_combine(array_column($data, 0), array_fill(0, count($data), 0));
        for ($i = 0; $i < $duration; $i++) {
            foreach ($data as $reindeer) {
                if ($i % ($reindeer[2] + $reindeer[3]) < $reindeer[2]) {
                    $distances[$reindeer[0]] += $reindeer[1];
                }
            }

            $lead = max($distances);
            foreach ($distances as $reindeer => $distance) {
                if ($distance === $lead) $score[$reindeer] += 1;
            }
        }
        return max($score);
    }

    private function parseInput(string $input): array
    {
        return array_map(function (string $line) {
            return sscanf($line, '%s can fly %d km/s for %d seconds, but then must rest for %d seconds.');
        }, explode(PHP_EOL, trim($input)));
    }
}
