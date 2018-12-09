<?php

namespace Mzentrale\AdventOfCode\Year2015;

use Mzentrale\AdventOfCode\Puzzle;

class Day5 implements Puzzle
{
    public function part1(string $input)
    {
        return count(array_filter(explode(PHP_EOL, trim($input)), [$this, 'isNice']));
    }

    public function part2(string $input)
    {
        return count(array_filter(explode(PHP_EOL, trim($input)), [$this, 'isNicer']));
    }

    public function isNice(string $string): bool
    {
        return $this->hasVowels($string) && $this->hasDoubles($string) && !$this->hasForbidden($string);
    }

    private function hasVowels(string $string, int $count = 3): bool
    {
        return strlen($string) - strlen(str_replace(['a', 'e', 'i', 'o', 'u'], '', $string)) >= $count;
    }

    private function hasDoubles(string $string): bool
    {
        for ($i = 0, $len = strlen($string) - 1; $i < $len; $i++) {
            if ($string{$i} === $string{$i + 1}) {
                return true;
            }
        }
        return false;
    }

    private function hasForbidden(string $string): bool
    {
        return strlen($string) > strlen(str_replace(['ab', 'cd', 'pq', 'xy'], '', $string));
    }

    public function isNicer(string $string): bool
    {
        return $this->hasPairs($string) && $this->hasRepeat($string);
    }

    private function hasPairs(string $string): bool
    {
        for ($i = 0, $len = strlen($string) - 1; $i < $len; $i++) {
            if (strlen($string) - strlen(str_replace(substr($string, $i, 2), '', $string)) >= 4) {
                return true;
            }
        }
        return false;
    }

    private function hasRepeat(string $string): bool
    {
        for ($i = 0, $len = strlen($string) - 2; $i < $len; $i++) {
            if ($string{$i} === $string{$i + 2}) {
                return true;
            }
        }
        return false;
    }
}
