<?php

namespace Mzentrale\AdventOfCode\Year2015;

use Mzentrale\AdventOfCode\Puzzle;

class Day3 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->deliverPresents($input);
    }

    public function part2(string $input)
    {
        return $this->deliverWithRobosanta($input);
    }

    public function deliverPresents(string $input): int
    {
        $current        = [0, 0];
        $visited['0:0'] = 1;
        for ($i = 0, $end = strlen(trim($input)); $i < $end; $i++) {
            switch ($input{$i}) {
                case '>':
                    $current[0] += 1;
                    break;
                case '<':
                    $current[0] -= 1;
                    break;
                case '^':
                    $current[1] += 1;
                    break;
                case 'v':
                    $current[1] -= 1;
                    break;
            }

            $visited[implode(':', $current)] = ($visited[implode(':', $current)] ?? 0) + 1;
        }

        return count($visited);
    }

    public function deliverWithRobosanta(string $input): int
    {
        $santa = [0, 0];
        $robot = [0, 0];

        $visited['0:0'] = 2;
        for ($i = 0, $end = strlen(trim($input)); $i < $end; $i++) {
            $current = $i % 2 === 0 ? $santa : $robot;

            switch ($input{$i}) {
                case '>':
                    $current[0] += 1;
                    break;
                case '<':
                    $current[0] -= 1;
                    break;
                case '^':
                    $current[1] += 1;
                    break;
                case 'v':
                    $current[1] -= 1;
                    break;
            }

            $visited[implode(':', $current)] = ($visited[implode(':', $current)] ?? 0) + 1;

            $i % 2 === 0 ? $santa = $current : $robot = $current;
        }

        return count($visited);
    }
}
