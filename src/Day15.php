<?php

namespace Mzentrale\AdventOfCode;

class Day15 implements Puzzle
{
    const FACTOR_A = 16807;
    const FACTOR_B = 48271;

    private $remainder = 2147483647;

    private function parseInput(string $input)
    {
        preg_match_all('#starts with ([0-9]+)#m', $input, $matches);
        return array_map('intval', $matches[1] ?? []);
    }

    public function part1(string $input)
    {
        return $this->countMatches(...$this->parseInput($input));
    }

    public function part2(string $input)
    {
        return $this->countMatchesPart2(...$this->parseInput($input));
    }

    public function countMatches(int $a, int $b, int $max = 40000000): int
    {
        return $this->getCount($this->getGenerator(self::FACTOR_A, $a, $max), $this->getGenerator(self::FACTOR_B, $b, $max));
    }

    public function countMatchesPart2(int $a, int $b, int $max = 5000000): int
    {
        return $this->getCount($this->getPart2Generator(self::FACTOR_A, $a, $max, 4), $this->getPart2Generator(self::FACTOR_B, $b, $max, 8));
    }

    public function match(int $a, int $b): bool
    {
        $mask = (1 << 16) - 1;
        return ($a & $mask) === ($b & $mask);
    }

    public function getGenerator(int $factor, int $initial, int $count)
    {
        return $this->createGenerator($factor, $initial, $count);
    }

    private function getCount(\Generator $a, \Generator $b): int
    {
        $both = new \MultipleIterator();
        $both->attachIterator($a);
        $both->attachIterator($b);

        $count = 0;
        foreach ($both as $pair) {
            $this->match(...$pair) && $count++;
        }

        return $count;
    }

    public function getPart2Generator(int $factor, int $initial, int $count, int $divisibleBy = 1): \Generator
    {
        return $this->createGenerator($factor, $initial, $count, $divisibleBy);
    }

    private function createGenerator(int $factor, int $initial, int $count, int $divisibleBy = 1): \Generator
    {
        $number = $initial;
        while ($count > 0) {
            $number *= $factor;
            $number %= $this->remainder;
            if ($number % $divisibleBy === 0) {
                yield $number;
                $count--;
            }
        };
    }
}
