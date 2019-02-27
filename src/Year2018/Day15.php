<?php

namespace Mzentrale\AdventOfCode\Year2018;

use Mzentrale\AdventOfCode\Puzzle;

class Day15 implements Puzzle
{
    private const HIT_POINTS = 200;
    private const NOT_FOUND  = 99999;

    public function part1(string $input)
    {
        return $this->getBattleOutCome($input);
    }

    public function part2(string $input)
    {
        return $this->helpElvesWin($input);
    }

    public function getBattleOutCome(string $input, int $elfAttackPower = 3, bool $elvesWin = false): int
    {
        [$units, $field, $next] = $this->parseInput($input);

        $rounds = 0;
        while (!$this->isOver($units)) {
            for ($i = 0, $max = count($units); $i < $max; $i++) {
                if ($units[$i][2] <= 0) continue; // If the unit died...

                [$type, $position] = $units[$i];

                // Already in range?
                $enemies = $this->getEnemies($type, $units);
                $target  = $this->getTarget($next($position), $enemies);
                if ($target !== self::NOT_FOUND) {
                    $units[$target][2] -= $type === 'E' ? $elfAttackPower : 3;
                    if ($units[$target][2] <= 0) {
                        if ($type !== 'E' && $elvesWin) return -1;
                        $field{$units[$target][1]} = '.';
                    }
                    continue;
                }

                // No target, try to move
                $inRange  = array_merge([], ...array_map($next, array_keys($enemies)));
                $nextStep = $this->findNextStep($position, $inRange, $field, $next);
                if ($nextStep === self::NOT_FOUND) {
                    if ($this->isOver($units)) {
                        $rounds -= 1;
                        break;
                    }
                    continue;
                }

                // Attack if in range
                $units[$i][1] = $nextStep;
                $field        = $this->move($position, $nextStep, $field);
                $target       = $this->getTarget($next($nextStep), $enemies);
                if ($target === self::NOT_FOUND) continue;

                $units[$target][2] -= $type === 'E' ? $elfAttackPower : 3;
                if ($units[$target][2] <= 0) {
                    if ($type !== 'E' && $elvesWin) return -1;
                    $field{$units[$target][1]} = '.';
                }
            }

            $units  = $this->sort($units);
            $rounds += 1;
        }

        return array_sum(array_column($units, 2)) * $rounds;
    }

    public function helpElvesWin(string $input): int
    {
        for ($elfAttackPower = 4, $outcome = -1; $outcome < 0; $elfAttackPower++) {
            $outcome = $this->getBattleOutCome($input, $elfAttackPower, true);
        }
        return $outcome;
    }

    private function isOver(array $units): int
    {
        $units = array_filter($units, function (array $unit): bool {
            return $unit[2] > 0;
        });
        return count(array_unique(array_column($units, 0))) === 1;
    }

    private function findNextStep(int $from, array $targets, string $field, callable $next): int
    {
        $seen  = [$from];
        $queue = [[$from, -1]];
        while ($queue) {
            [$curr, $firstStep] = array_shift($queue);
            foreach ($next($curr) as $p) {
                if (in_array($p, $seen) || $field{$p} !== '.') continue;
                if (in_array($p, $targets)) return $firstStep > 0 ? $firstStep : $p;
                $seen[]  = $p;
                $queue[] = [$p, $firstStep > 0 ? $firstStep : $p];
            }
        }
        return self::NOT_FOUND;
    }

    private function getTarget(array $adjacient, array $enemies): int
    {
        return array_reduce($adjacient, function (array $result, int $p) use ($enemies): array {
            return ($enemies[$p][1] ?? self::NOT_FOUND) < $result[1] ? $enemies[$p] : $result;
        }, [self::NOT_FOUND, self::NOT_FOUND])[0];
    }

    private function getEnemies(string $type, array $units): array
    {
        for ($i = 0, $enemies = [], $max = count($units); $i < $max; $i++) {
            if ($units[$i][0] !== $type && $units[$i][2] > 0) $enemies[$units[$i][1]] = [$i, $units[$i][2]];
        }
        return $enemies;
    }

    private function move(int $from, int $to, string $field): string
    {
        $field{$to}   = $field{$from};
        $field{$from} = '.';
        return $field;
    }

    private function next(string $field): callable
    {
        $width = strpos($field, PHP_EOL) + 1;
        return function (int $pos) use ($width): array {
            return [$pos - $width, $pos - 1, $pos + 1, $pos + $width];
        };
    }

    private function parseInput(string $input): array
    {
        $units = [];
        foreach (['E', 'G'] as $type) {
            $offset = 0;
            while (($unit = strpos($input, $type, $offset)) !== false) {
                $units[] = [$type, $unit, self::HIT_POINTS];
                $offset  = $unit + 1;
            }
        }
        return [$this->sort($units), $input, $this->next($input)];
    }

    private function sort(array $units): array
    {
        $units = array_filter($units, function (array $unit): bool {
            return $unit[2] > 0;
        });
        usort($units, function (array $a, array $b): int {
            return $a[1] - $b[1];
        });
        return $units;
    }
}
