<?php

namespace Mzentrale\AdventOfCode\Year2015;

use Mzentrale\AdventOfCode\Puzzle;

class Day16 implements Puzzle
{
    /** @var array */
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function part1(string $input)
    {
        foreach ($this->parseInput($input) as $id => $facts) {
            foreach ($facts as $what => $qty) {
                if ($this->data[$what] != $qty) continue 2;
            }
            return $id;
        }
    }

    public function part2(string $input)
    {
        foreach ($this->parseInput($input) as $id => $facts) {
            foreach ($facts as $what => $qty) {
                switch ($what) {
                    case 'cats':
                    case 'trees':
                        if ($this->data[$what] >= $qty) continue 3;
                        break;
                    case 'pomeranians':
                    case 'goldfish':
                        if ($this->data[$what] <= $qty) continue 3;
                        break;
                        break;
                    default:
                        if ($this->data[$what] != $qty) continue 3;
                        break;
                }
            }
            return $id;
        }
    }

    private function parseInput(string $input): array
    {
        return array_reduce(explode(PHP_EOL, trim($input)), function (array $aunts, string $aunt) {
            list($id, $data) = explode(': ', substr($aunt, strlen('Sue ')), 2);
            $facts      = array_map(function (string $fact) {
                return explode(': ', $fact);
            }, explode(', ', $data));
            $aunts[$id] = array_combine(array_column($facts, 0), array_column($facts, 1));
            return $aunts;
        }, []);
    }
}
