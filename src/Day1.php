<?php

namespace Mzentrale\AdventOfCode;

class Day1 implements Puzzle
{
    public function captcha($code)
    {
        $chars    = str_split(trim($code));
        $numChars = count($chars);
        return array_sum(array_filter($chars, function ($position) use ($chars, $numChars) {
            return $chars[$position] === $chars[($position + 1) % $numChars];
        }, ARRAY_FILTER_USE_KEY));
    }

    public function solve($input)
    {
        return $this->captcha($input);
    }
}
