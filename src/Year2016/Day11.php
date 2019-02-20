<?php

namespace Mzentrale\AdventOfCode\Year2016;

use Mzentrale\AdventOfCode\Puzzle;

class Day11 implements Puzzle
{
    private const PATTERN        = '#([a-z]+)(-compatible microchip| generator)#';
    private const MICROCHIP      = 1;
    private const GENERATOR      = 2;
    private const ALL_GENERATORS = 43690;

    public function part1(string $input)
    {
        return $this->collectForAssembly($input);
    }

    public function part2(string $input)
    {
        return $this->collectForAssembly($input, 15); // = 1111, all on floor 0
    }

    public function collectForAssembly(string $input, int $withAdditional = 0): int
    {
        $initial = $this->parseInput($input);
        if ($withAdditional) {
            $initial[0] += $withAdditional << (int) log(array_sum($initial) + 1, 2);
        }

        $result = array_sum($initial);
        $seen   = [$this->hash($initial, $result, 0)];
        $queue  = [[0, 0, $initial]];
        while ($queue) {
            [$steps, $elevator, $floors] = array_shift($queue);

            foreach ($this->nextStep($floors[$elevator]) as $next) {
                if (!$this->isValid($floors[$elevator] - $next)) continue;
                foreach ([1, -1] as $dir) {
                    if (isset($floors[$elevator + $dir]) && $this->isValid($floors[$elevator + $dir] + $next)) {
                        $newFloors = $floors;
                        $newFloors[$elevator] -= $next;
                        $newFloors[$elevator + $dir] += $next;
                        if ($newFloors[3] === $result) return $steps + 1;

                        $track = $this->hash($newFloors, $result, $elevator + $dir);
                        if (in_array($track, $seen)) continue;

                        $seen[]  = $track;
                        $queue[] = [$steps + 1, $elevator + $dir, $newFloors];
                    }
                }
            }
        }
        return -1;
    }

    private function hash(array $floors, int $max, int $elevator = 0): string
    {
        for ($s = 0, $hash = []; (1 << $s) < $max; $s += 2) {
            for ($i = $state = 0; $i < 4; $i++) {
                $floor = $floors[$i] >> $s;
                $state += (($floor & self::MICROCHIP) + (($floor & self::GENERATOR) << 1)) * $i;
            }
            $hash[] = dechex($state); // Represents G+M positions with 4bits (2 for G and 2 for M)
        }
        sort($hash);
        return $elevator . implode('', $hash);
    }

    function nextStep(int $floor): array
    {
        $next = [];
        for ($j = 1; $j <= $floor; $j <<= 1) {
            if (($floor & $j) !== $j) continue;
            $next[] = $j;
            for ($k = $j << 1; $k <= $floor; $k <<= 1) {
                if (($floor & $j + $k) === $j + $k) $next[] = $j + $k;
            }
        }
        return $next;
}

    private function isValid(int $floor): bool
    {
        for ($i = 1; $floor & self::ALL_GENERATORS && $i <= $floor; $i <<= 2) {
            if ($floor & $i && ($floor & ($i << 1)) === 0) return false;
        }
        return true;
    }

    private function parseInput(string $input): array
    {
        preg_match_all(self::PATTERN, $input, $match);
        $rocks = array_flip(array_values(array_unique($match[1] ?? [])));

        return array_map(function (string $line) use ($rocks): int {
            $floor = 0;
            preg_match_all(self::PATTERN, $line, $match);
            foreach (($match[1] ?? []) as $i => $rock) {
                $floor += ($match[2][$i] === ' generator' ? self::GENERATOR : self::MICROCHIP) << $rocks[$rock] * 2;
            }
            return $floor;
        }, explode(PHP_EOL, trim($input)));
    }
}
