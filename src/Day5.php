<?php

namespace Mzentrale\AdventOfCode;

class Day5 implements Puzzle
{
    public function solve($input)
    {
        return $this->exit($this->splitCommands($input));
    }

    public function splitCommands($commands): array
    {
        return array_map('intval', explode(PHP_EOL, trim($commands)));
    }

    public function exit(array $offsets)
    {
        $current    = 0;
        $offsets    = array_values($offsets);
        $numOffsets = count($offsets);
        $i          = 0;
        for (; $current < $numOffsets; $i++) {
            $jump              = $offsets[$current];
            $offsets[$current] += 1;
            $current           += $jump;
        }
        return $i;
    }
}
