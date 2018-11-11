<?php

namespace Mzentrale\AdventOfCode;

class Day25 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->getChecksum($input);
    }

    public function part2(string $input)
    {
        // TODO: Implement part2() method.
    }

    public function getStepCount(string $input): int
    {
        return (int) $this->getMatch('#Perform a diagnostic checksum after ([0-9]+) steps\.#', $input);
    }

    public function getBegin(string $input): string
    {
        return $this->getMatch('#Begin in state ([A-Z])\.#', $input);
    }

    public function getSteps(string $input): array
    {
        $steps = [];
        foreach (explode("\n\n", substr($input, strpos($input, 'In state '))) as $data) {
            $state = $this->getMatch('#In state ([A-Z]):#', $data);
            foreach (explode('If the current value is ', substr($data, strpos($data, 'If the current value is '))) as $values) {
                $steps[$state][(int) substr($values, 0, 1)] = [
                    (int) $this->getMatch('#- Write the value ([0-9])\.#', $values),
                    strpos($values, '- Move one slot to the right.') !== false ? 1 : -1,
                    $this->getMatch('#- Continue with state ([A-Z])\.#', $values),
                ];
            }
        }
        return $steps;
    }

    private function getMatch(string $pattern, string $subject): string
    {
        preg_match($pattern, $subject, $match);
        return $match[1] ?? '';
    }

    public function getChecksum(string $input): int
    {
        $count    = $this->getStepCount($input);
        $steps    = $this->getSteps($input);
        $current  = $this->getBegin($input);
        $tape     = [];
        $position = 0;
        for ($i = 0; $i < $count; $i++) {
            $step            = $steps[$current][$tape[$position] ?? 0];
            $tape[$position] = $step[0];
            $position        += $step[1];
            $current         = $step[2];
        }
        return array_sum($tape);
    }
}
