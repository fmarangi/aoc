<?php

namespace Mzentrale\AdventOfCode\Year2018;

use Mzentrale\AdventOfCode\Puzzle;

class Day16 implements Puzzle
{
    /** @var Day16\Opcodes */
    private $opcodes;

    public function __construct()
    {
        $this->opcodes = new Day16\Opcodes();
    }

    public function part1(string $input)
    {
        list($samples) = explode(PHP_EOL . PHP_EOL . PHP_EOL, $input);

        $found = 0;
        foreach (explode(PHP_EOL . PHP_EOL, $samples) as $sample) {
            $found += $this->getMatching($sample) >= 3 ? 1 : 0;
        }
        return $found;
    }

    public function part2(string $input)
    {
        list(, $run) = explode(PHP_EOL . PHP_EOL . PHP_EOL, $input);
        $registers = [0, 0, 0, 0];
        foreach (explode(PHP_EOL, trim($run)) as $row) {
            $registers = ($this->opcodes)($this->toList($row), $registers);
        }
        return $registers[0];
    }

    public function getMatching(string $sample): int
    {
        list($before, $instruction, $after) = explode(PHP_EOL, trim($sample));
        list(, $before) = explode(': [', substr($before, 0, -1));
        list(, $after) = explode(':  [', substr($after, 0, -1));
        [$from, $to, $i] = array_map([$this, 'toList'], [$before, $after, $instruction]);

        $matching = 0;
        foreach ($this->opcodes->all() as $opcode => $func) {
            $matching += $func($i, $from) === $to ? 1 : 0;
        }
        return $matching;
    }

    private function toList(string $string): array
    {
        return array_map('intval', explode(' ', trim($string)));
    }
}
