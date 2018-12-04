<?php

namespace Mzentrale\AdventOfCode\Year2018;

use Mzentrale\AdventOfCode\Puzzle;

class Day4 implements Puzzle
{
    public function part1(string $input)
    {
        return $this->getTargetGuard($input) * $this->getTargetMinute($input);
    }

    public function part2(string $input)
    {
        return $this->getMostSleptMinute($input);
    }

    public function getTargetGuard(string $input): int
    {
        return $this->targetGuard($this->parseInput($input));
    }

    public function getTargetMinute(string $input): int
    {
        $records = $this->parseInput($input);
        $guard   = $this->targetGuard($records);
        return $this->targetMinute($records[$guard]);
    }

    private function parseInput(string $input): array
    {
        $records = explode(PHP_EOL, trim($input));
        sort($records);

        $guards  = [];
        $current = 0;
        foreach ($records as $record) {
            list($date, $action) = explode('] ', trim($record, '['));
            if (strpos($action, 'begins shift')) {
                list($current) = sscanf($action, 'Guard #%d begins shift');
                continue;
            }

            list($date, $minute) = explode(' 00:', $date);
            $guards[$current][$date][] = (int) $minute;
        }
        return $guards;
    }

    private function getSleep(array $minutes)
    {
        $sleeping = false;
        $from     = 0;
        $slept    = 0;
        foreach ($minutes as $minute) {
            $sleeping = !$sleeping;
            if ($sleeping) {
                $from = $minute;
                continue;
            }

            $slept += $minute - $from;
        }
        return $slept;
    }

    private function getNight(array $minutes): int
    {
        $sleeping = false;
        $night    = 0;
        for ($i = 0; $i < 59; $i++) {
            if (in_array($i, $minutes)) {
                $sleeping = !$sleeping;
            }

            if ($sleeping) {
                $night += (1 << $i);
            }
        }
        return $night;
    }

    private function targetGuard(array $records): int
    {
        $sleeps = array_map(function (array $nights) {
            return array_sum(array_map([$this, 'getSleep'], $nights));
        }, $records);
        return array_search(max($sleeps), $sleeps);
    }

    private function targetMinute(array $nights): int
    {
        $nights  = array_map([$this, 'getNight'], $nights);
        $minutes = array_map(function (int $minute) use ($nights) {
            return count(array_filter($nights, function (int $night) use ($minute) {
                return $night & (1 << $minute);
            }));
        }, range(0, 59));
        return array_search(max($minutes), $minutes);
    }

    private function getMaxFrequency(array $nights): int
    {
        $nights = array_map([$this, 'getNight'], $nights);
        return max(array_map(function (int $minute) use ($nights) {
            return count(array_filter($nights, function (int $night) use ($minute) {
                return $night & (1 << $minute);
            }));
        }, range(0, 59)));
    }

    public function getMostSleptMinute(string $input): int
    {
        $records = $this->parseInput($input);
        $guards  = array_map([$this, 'getMaxFrequency'], $records);
        $guard   = array_search(max($guards), $guards);
        return $this->targetMinute($records[$guard]) * $guard;
    }
}
