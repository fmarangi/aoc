<?php

namespace Mzentrale\AdventOfCode;

use Mzentrale\AdventOfCode\Day18\Program;

class Day18 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->getRecoveredFrequency($input);
    }

    public function part2(string $input)
    {
        return $this->runPrograms($input);
    }

    public function getRecoveredFrequency(string $input): int
    {
        $instructions = $this->parseInput($input);
        $program      = new Program(0);
        $frequency    = 0;
        for ($i = 0, $num = count($instructions); $i < $num; $i++) {
            try {
                $i += $program->runInstruction($instructions[$i]);
            } catch (\Exception $e) {
                $frequency = $e->getCode();
                break;
            }
        }
        return $frequency;
    }


    public function runPrograms(string $input): int
    {
        $a = new Program(0);
        $b = new Program(1);

        $j = $k = 0;

        $instructions = $this->parseInput($input);

        $run = function (Program $a, Program $b, int $step) use ($instructions): int {
            $data = $instructions[$step] ?? ['none'];
            switch ($data[0]) {
                case 'snd':
                    $a->send($data[1]);
                    return $step + 1;
                case 'rcv':
                    if (($receive = $b->dequeue()) !== null) {
                        $a->receive($data[1], $receive);
                        $step++;
                    }
                    return $step;
                default:
                    return $step + $a->runInstruction($data) + 1;
            }
        };

        while (true) {
            $currJ = $j;
            $currK = $k;
            $j     = $run($a, $b, $j);
            $k     = $run($b, $a, $k);

            if ($k === $currK && $j === $currJ) break;
        }
        return $b->getSent();
    }

    private function parseInput(string $input): array
    {
        return array_map(function (string $line): array {
            return explode(' ', $line);
        }, explode(PHP_EOL, trim($input)));
    }
}
