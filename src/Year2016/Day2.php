<?php

namespace Mzentrale\AdventOfCode\Year2016;

use Mzentrale\AdventOfCode\Puzzle;

class Day2 implements Puzzle
{
    const DESIGN_1 = '123456789';
    const DESIGN_2 = '  1   234 56789 ABC   D  ';

    public function part1(string $input)
    {
        return $this->getCode($input);
    }

    public function part2(string $input)
    {
        return $this->getCode($input, self::DESIGN_2);
    }

    public function getCode(string $input, string $buttons = self::DESIGN_1): string
    {
        $code   = '';
        $button = '5';
        foreach (explode(PHP_EOL, trim($input)) as $line) {
            $button = $this->getButton($line, $buttons, $button);
            $code   .= $button;
        }
        return $code;
    }

    private function getButton(string $line, string $buttons, string $initial = '5'): string
    {
        $max    = strlen($buttons);
        $button = strpos($buttons, $initial);
        $length = (int) sqrt($max);
        $moves  = ['U' => -$length, 'D' => $length, 'L' => -1, 'R' => 1];
        foreach (str_split(trim($line)) as $direction) {
            $check = $button + $moves[$direction];
            if (($direction === 'R' || $direction === 'L') && floor($button / $length) !== floor($check / $length)) {
                continue;
            }
            if ($check < 0 || $check >= $max) {
                continue;
            }
            if ($buttons{$check} === ' ') {
                continue;
            }
            $button = $check;
        }
        return $buttons{$button};
    }
}
