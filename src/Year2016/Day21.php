<?php

namespace Mzentrale\AdventOfCode\Year2016;

use Mzentrale\AdventOfCode\Puzzle;

class Day21 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->scramble('abcdefgh', explode(PHP_EOL, trim($input)));
    }

    public function part2(string $input)
    {
        return $this->unscramble('fbgdceah', explode(PHP_EOL, trim($input)));
    }

    public function scramble(string $password, array $operations): string
    {
        return array_reduce($operations, [$this, 'apply'], $password);
    }

    public function unscramble(string $password, array $operations): string
    {
        return array_reduce(array_reverse($operations), [$this, 'unapply'], $password);
    }

    public function apply(string $string, string $rule): string
    {
        $rules = [
            '#swap position (\d) with position (\d)#' => [$this, 'swap'],
            '#reverse positions (\d) through (\d)#'   => [$this, 'reverse'],
            '#move position (\d) to position (\d)#'   => [$this, 'move'],

            '#swap letter (\w) with letter (\w)#' => function (string $string, string $a, string $b) {
                return $this->swap($string, strpos($string, $a), strpos($string, $b));
            },

            '#rotate (\w+) (\d) step#' => function (string $string, string $direction, int $steps) {
                return $this->rotate($string, $steps, $direction === 'right');
            },

            '#rotate based on position of letter (\w)#' => function (string $string, string $a) {
                $steps = strpos($string, $a);
                $steps += $steps >= 4 ? 2 : 1;
                return $this->rotate($string, $steps % strlen($string));
            },
        ];

        foreach ($rules as $pattern => $apply) {
            if (preg_match($pattern, $rule, $match)) {
                return $apply($string, ...array_slice($match, 1));
            }
        }

        return $string;
    }

    public function unapply(string $string, string $rule): string
    {
        $rules = [
            '#swap position (\d) with position (\d)#' => [$this, 'swap'],
            '#move position (\d) to position (\d)#'   => [$this, 'move'],

            '#reverse positions (\d) through (\d)#' => function (string $string, int $b, int $a): string {
                return substr($string, 0, $a) . strrev(substr($string, $a, $b - $a + 1)) . substr($string, $b + 1);
            },

            '#swap letter (\w) with letter (\w)#' => function (string $string, string $a, string $b) {
                return $this->swap($string, strpos($string, $a), strpos($string, $b));
            },

            '#rotate (\w+) (\d) step#' => function (string $string, int $steps, string $direction) {
                return $this->rotate($string, $steps, $direction !== 'right');
            },

            '#rotate based on position of letter (\w)#' => function (string $string) use ($rule) {
                for ($res = $string; $string !== $this->apply($res, $rule); $res = $this->rotate($res, 1, false)) {
                    continue;
                }
                return $res;
            },
        ];

        foreach ($rules as $pattern => $apply) {
            if (preg_match($pattern, $rule, $match)) {
                return $apply($string, ...array_reverse(array_slice($match, 1)));
            }
        }

        return $string;
    }

    private function swap(string $string, int $posA, int $posB): string
    {
        list($a, $b) = [$string{$posA}, $string{$posB}];
        $string{$posA} = $b;
        $string{$posB} = $a;
        return $string;
    }

    private function rotate(string $string, int $steps, bool $right = true): string
    {
        return $right ? substr($string, -$steps) . substr($string, 0, -$steps) : substr($string, $steps) . substr($string, 0, $steps);
    }

    private function reverse(string $string, int $a, int $b): string
    {
        return substr($string, 0, $a) . strrev(substr($string, $a, $b - $a + 1)) . substr($string, $b + 1);
    }

    private function move(string $string, int $a, int $b)
    {
        $chars = str_split($string);
        array_splice($chars, $a, 1);
        array_splice($chars, $b, 0, [$string{$a}]);
        return implode('', $chars);
    }
}
