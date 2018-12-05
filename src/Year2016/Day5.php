<?php

namespace Mzentrale\AdventOfCode\Year2016;

use Mzentrale\AdventOfCode\Puzzle;

class Day5 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->getPassword(trim($input));
    }

    public function part2(string $input)
    {
        return $this->getSecondPassword(trim($input));
    }

    public function getPassword(string $doorId, int $length = 8): string
    {
        $i        = 0;
        $password = '';
        while (strlen($password) < $length) {
            $test = md5($doorId . $i++);
            if (substr($test, 0, 5) === '00000') {
                $password .= substr($test, 5, 1);
            }
        }
        return $password;
    }

    public function getSecondPassword(string $doorId, int $length = 8): string
    {
        $i        = 0;
        $password = str_repeat('-', $length);
        while (strlen(str_replace('-', '', $password)) < $length) {
            $test = md5($doorId . $i++);
            if (substr($test, 0, 5) === '00000') {
                $pos = ord(substr($test, 5, 1));
                if ($pos >= 48 && $pos <= 55 && $password{substr($test, 5, 1)} === '-') {
                    $password{substr($test, 5, 1)} = substr($test, 6, 1);
                }
            }
        }
        return $password;
    }
}
