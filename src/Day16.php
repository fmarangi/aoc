<?php

namespace Mzentrale\AdventOfCode;

class Day16 implements Puzzle
{
    const PROGRAMS = 'abcdefghijklmnop';

    public function part1(string $input)
    {
        return $this->dance(self::PROGRAMS, trim($input));
    }

    public function part2(string $input)
    {
        return $this->dance(self::PROGRAMS, trim($input), 1000000000);
    }

    public function dance(string $programs, string $moves, int $repeat = 1)
    {
        $i       = 0;
        $initial = $programs;
        while ($i++ < $repeat) {
            $programs = $this->moves($programs, $moves);
            if ($programs === $initial) {
                return $this->dance($initial, $moves, $repeat % $i);
            }
        }
        return $programs;
    }

    public function move(string $sequence, string $move): string
    {
        if (preg_match('#(p|s|x)((\d+)(?:/(\d+))?|([a-p])/([a-p]))#', $move, $matches)) {
            switch ($matches[1]) {
                case 's':
                    return $this->spin($sequence, $matches[3]);
                case 'x':
                    return $this->exchange($sequence, $matches[3], $matches[4]);
                case 'p':
                    return $this->exchange($sequence, strpos($sequence, $matches[5]), strpos($sequence, $matches[6]));
            }
        }
    }

    private function spin(string $sequence, int $numPrograms): string
    {
        return substr($sequence, -$numPrograms) . substr($sequence, 0, strlen($sequence) - $numPrograms);
    }

    private function exchange(string $sequence, int $a, int $b): string
    {
        list($newB, $newA) = [$sequence[$a], $sequence[$b]];
        $sequence[$a] = $newA;
        $sequence[$b] = $newB;
        return $sequence;
    }

    private function moves(string $programs, string $moves): string
    {
        return array_reduce(explode(',', $moves), function (string $programs, string $move) {
            return $this->move($programs, $move);
        }, $programs);
    }
}
