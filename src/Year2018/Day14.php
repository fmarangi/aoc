<?php

namespace Mzentrale\AdventOfCode\Year2018;

use Mzentrale\AdventOfCode\Puzzle;

class Day14 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->getScoreAfter((int) $input);
    }

    public function part2(string $input)
    {
        return $this->getAppearsAfter(trim($input));
    }

    public function getScoreAfter(int $recipes, string $initial = '37'): string
    {
        for ($i = strlen($initial), $a = 0, $b = 1; $i < $recipes + 10;) {
            $recipe  = $initial{$a} + $initial{$b};
            $i       += strlen($recipe);
            $initial .= $recipe;

            $a = ($a + $initial{$a} + 1) % strlen($initial);
            $b = ($b + $initial{$b} + 1) % strlen($initial);
        }
        return substr($initial, $recipes, 10);
    }

    public function getAppearsAfter(string $pattern, string $initial = '37'): int
    {
        $patternLength = strlen($pattern) + 1;
        for ($i = strlen($initial), $a = 0, $b = 1, $found = false; $found === false;) {
            $recipe  = $initial{$a} + $initial{$b};
            $i       += strlen($recipe);
            $initial .= $recipe;

            $a = ($a + $initial{$a} + 1) % strlen($initial);
            $b = ($b + $initial{$b} + 1) % strlen($initial);

            $found = strpos(substr($initial, -$patternLength), $pattern);
        }
        return $i - $patternLength + $found;
    }
}
