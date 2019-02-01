<?php

namespace Mzentrale\AdventOfCode\Year2018;

use Mzentrale\AdventOfCode\Puzzle;

class Day2 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->getChecksum($input);
    }

    public function part2(string $input)
    {
        return $this->getSimilar($input);
    }

    public function hasTwoLetters(string $boxId): bool
    {
        return array_search(2, $this->getLetterCount($boxId)) !== false;
    }

    public function hasTreeLetters(string $boxId)
    {
        return array_search(3, $this->getLetterCount($boxId)) !== false;
    }

    public function getChecksum(string $boxIds)
    {
        $boxes        = explode(PHP_EOL, trim($boxIds));
        $twoLetters   = array_filter($boxes, [$this, 'hasTwoLetters']);
        $threeLetters = array_filter($boxes, [$this, 'hasTreeLetters']);
        return count($twoLetters) * count($threeLetters);
    }

    public function getDifferences(string $a, string $b): int
    {
        for ($i = $differences = 0, $len = strlen($a); $i < $len; $i++) {
            $differences += $a{$i} !== $b{$i} ? 1 : 0;
        }
        return $differences;
    }

    public function getCommon(string $a, string $b): string
    {
        $common = '';
        foreach (str_split($a) as $i => $j) {
            $common .= $b{$i} === $j ? $j : '';
        }
        return $common;
    }

    public function getSimilar(string $boxes): string
    {
        $ids = explode(PHP_EOL, trim($boxes));
        foreach ($ids as $a) {
            foreach ($ids as $b) {
                if ($this->getDifferences($a, $b) === 1) return $this->getCommon($a, $b);
            }
        }
    }

    private function getLetterCount(string $boxId): array
    {
        return array_count_values(str_split($boxId));
    }
}
