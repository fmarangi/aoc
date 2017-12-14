<?php

namespace Mzentrale\AdventOfCode;

class Day5 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->exit1($this->splitCommands($input));
    }

    public function part2(string $input)
    {
        return $this->exit2($this->splitCommands($input));
    }

    public function splitCommands($commands): array
    {
        return array_map('intval', explode(PHP_EOL, trim($commands)));
    }

    public function exit1(array $offsets)
    {
        return $this->exit($offsets, function () {
            return 1;
        });
    }

    public function exit2(array $offsets)
    {
        return $this->exit($offsets, function ($jump) {
            return $jump >= 3 ? -1 : 1;
        });
    }

    private function exit(array $offsets, \Closure $increment)
    {
        $current    = 0;
        $offsets    = array_values($offsets);
        $numOffsets = count($offsets);
        $i          = 0;
        for (; $current < $numOffsets; $i++) {
            $jump              = $offsets[$current];
            $offsets[$current] += $increment($jump);
            $current           += $jump;
        }
        return $i;
    }
}
