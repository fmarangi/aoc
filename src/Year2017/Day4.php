<?php

namespace Mzentrale\AdventOfCode\Year2017;

use Mzentrale\AdventOfCode\Puzzle;

class Day4 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->countUnique($input);
    }

    public function part2(string $input)
    {
        return $this->countWithoutAnagrams($input);
    }

    public function hasNoDuplicates($passphrase): bool
    {
        $parts = preg_split('#\s+#', $passphrase);
        return count($parts) === count(array_unique($parts));
    }

    public function hasNoAnagrams($passphrase): bool
    {
        $parts = array_map(function ($part) {
            $chars = str_split($part);
            sort($chars);
            return implode('', $chars);
        }, preg_split('#\s+#', $passphrase));
        return count($parts) === count(array_unique($parts));
    }

    public function countUnique($passprases): int
    {
        return count(array_filter(explode(PHP_EOL, trim($passprases)), [$this, 'hasNoDuplicates']));
    }

    public function countWithoutAnagrams($passprases): int
    {
        return count(array_filter(explode(PHP_EOL, trim($passprases)), [$this, 'hasNoAnagrams']));
    }
}
