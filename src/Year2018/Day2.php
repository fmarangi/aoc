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
        $twoLetters   = array_map([$this, 'hasTwoLetters'], $boxes);
        $threeLetters = array_map([$this, 'hasTreeLetters'], $boxes);
        return count(array_filter($twoLetters)) * count(array_filter($threeLetters));
    }

    public function getDifferences(string $a, string $b): int
    {
        $differences = 0;
        foreach (str_split($a) as $i => $j) {
            if ($b{$i} !== $j) $differences++;
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
        $count = [];
        foreach (str_split($boxId) as $letter) {
            $count[$letter] = ($count[$letter] ?? 0) + 1;
        }
        return $count;
    }
}
