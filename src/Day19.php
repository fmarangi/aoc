<?php

namespace Mzentrale\AdventOfCode;

class Day19 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->follow($input);
    }

    public function part2(string $input)
    {
        return $this->countSteps($input);
    }

    public function follow(string $schema): string
    {
        $board  = array_map('str_split', explode(PHP_EOL, $schema));
        $result = '';
        foreach ($this->getLetter($board) as $letter) {
            $result .= $letter;
        }
        return $result;
    }

    private function getLetter($board): \Generator
    {
        $search  = '|';
        $current = [0, array_search($search, $board[0])];
        $move    = [1, 0];
        $steps   = 0;

        while (true) {
            $next    = $board[$current[0] + $move[0]][$current[1] + $move[1]] ?? ' ';
            $current = [$current[0] + $move[0], $current[1] + $move[1]];
            $steps++;

            switch (true) {
                case preg_match('#[A-Z]#', $next):
                    yield $next;
                    break;
                case $search === $next:
                case $search === '|' && $next === '-' || $search === '-' && $next === '|':
                    break;
                case $next === '+':
                    $left  = $board[$current[0] + ($move[0] ? 0 : 1)][$current[1] + ($move[1] ? 0 : 1)] ?? ' ';
                    $right = $board[$current[0] + ($move[0] ? 0 : -1)][$current[1] + ($move[1] ? 0 : -1)] ?? ' ';

                    $search = $search === '|' ? '-' : '|';
                    if ($left !== ' ') {
                        $move = [$move[0] ? 0 : 1, $move[1] ? 0 : 1];
                    } elseif ($right !== ' ') {
                        $move = [$move[0] ? 0 : -1, $move[1] ? 0 : -1];
                    }
                    break;
                case $next === ' ':
                    break 2;
            }
        }

        return $steps;
    }

    public function countSteps(string $schema): int
    {
        $board   = array_map('str_split', explode(PHP_EOL, $schema));
        $letters = $this->getLetter($board);
        foreach ($letters as $letter) {
            continue;
        }
        return $letters->getReturn();
    }
}
