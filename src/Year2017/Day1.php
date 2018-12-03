<?php

namespace Mzentrale\AdventOfCode\Year2017;

use Mzentrale\AdventOfCode\Puzzle;

class Day1 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->captcha(trim($input));
    }

    public function part2(string $input)
    {
        return $this->captchaHalf(trim($input));
    }

    public function captcha($code, int $compareWith = 1)
    {
        $chars    = str_split($code);
        $numChars = count($chars);
        return array_sum(array_filter($chars, function ($position) use ($chars, $numChars, $compareWith) {
            return $chars[$position] === $chars[($position + $compareWith) % $numChars];
        }, ARRAY_FILTER_USE_KEY));
    }

    public function captchaHalf($code)
    {
        return $this->captcha($code, strlen($code) / 2);
    }
}
